<?php

namespace App\Jobs;

use App\Mail\ReportFinishMailable;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class ExportDatabaseRegister implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $repository;
    private $directory;
    private $requestedBy;
    private $mailToNotify;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($repository, $directory, $requestedBy, $mailToNotify = "")
    {
        $this->repository = $repository;
        $this->directory = $directory;
        $this->requestedBy = $requestedBy;
        $this->mailToNotify = $mailToNotify;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $requestStartAt = Carbon::now()->format("d-m-Y H:i");
        $registers = $this->repository->export();

        if (count($registers) < 1) {
            return;
        }

        $fileName = $this->generateFileName();
        $filePath = $this->createDirIfNotExists($fileName);
        $headers = $this->getHeaders($registers);
        $rows = $this->getRows($registers, $headers);
        $this->generateFile($filePath, $headers, $rows);

        $this->notify($fileName, $requestStartAt, $filePath);
    }

    /**
     *
     */
    private function generateFileName(): string
    {
        return uniqid("export_")
            . "_" . $this->repository->getTable() . "_"
            . Carbon::now()->format("y-m-d")
            . ".csv";
    }

    /**
     *
     */
    private function createDirIfNotExists(string $fileName): string
    {
        $fullFileDirectory = storage_path("app/$this->directory");
        if (!is_dir($fullFileDirectory)) {
            File::makeDirectory($fullFileDirectory, 0755, true);
        }
        return "$fullFileDirectory/$fileName";
    }

    /**
     *  @param Collection $registers
     */
    private function getHeaders($registers): array
    {
        $attributes = $registers->first()->getAttributes();
        $hiddenFields = $registers->first()->getHidden();

        return array_diff(array_keys($attributes), $hiddenFields);
    }

    /**
     * Extract registers rows from allowed headers (fields)
     *
     * @param Collection $registers
     * @param array $headers
     * @return array
     */
    private function getRows($registers, array $headers): array
    {
        $rows = [];

        /** @var Model $register */
        foreach ($registers as $register) {
            $attributes = $register->getAttributes();
            $rows[] = collect($attributes)->only($headers)->toArray();
        }

        return $rows;
    }

    /**
     * Generate export CSV file
     *
     * @param string $filePath
     * @param array $headers
     * @param array $rows
     * @return void
     */
    private function generateFile(string $filePath, array $headers, array $rows)
    {
        if (count($rows) < 1) {
            return;
        }

        $file = fopen($filePath, 'w');
        fputcsv($file, $headers);

        foreach ($rows as $row) {
            fputcsv($file, $row);
        }

        fclose($file);
    }

    /**
     * Notify user when report file request is finished
     *
     * @param string $fileName
     * @param string $requestedAt
     * @param string $filePath
     * @return void
     */
    private function notify(string $fileName, string $requestedAt, string $filePath)
    {
        if (!$this->mailToNotify) {
            return;
        }

        $mailable = new ReportFinishMailable($fileName, $this->requestedBy, $requestedAt, $filePath);

        $mailable->onQueue("emails");

        Mail::to($this->mailToNotify)->queue($mailable);
    }
}
