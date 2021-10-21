<?php

namespace App\Jobs;

use App\Mail\ReportFinishMailableImport;
use Carbon\Carbon;
use Hash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Log;

class ImportUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $repository;
    private $filePath;
    private $mailToNotify;
    private const NAME_COL = 1;
    private const EMAIL_COL = 2;
    private const DESCRIPTION_COL = 6;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($repository, string $filePath)
    {
        $this->filePath = $filePath;
        $this->repository = $repository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = storage_path("app/$this->filePath");
        $row = 1;
        $users = [];

        try {
            if (($handle = fopen($file, "r")) !== FALSE) {
                while (($dataCols = fgetcsv($handle, 0, ",")) !== FALSE) {
                    if ($this->repository->find_value("email", $dataCols[self::EMAIL_COL])) {
                        $row++;
                        continue;
                    }

                    if ($row != 1) {
                        $users[] = [
                            "name" => $dataCols[self::NAME_COL],
                            "email" => $dataCols[self::EMAIL_COL],
                            "description" => $dataCols[self::DESCRIPTION_COL],
                            "password" => Hash::make("password"),
                            "created_at" => Carbon::now(),
                            "updated_at" => Carbon::now(),
                        ];
                    }
                    $row++;
                }
            }
            if (count($users) > 0) {
                $this->repository->import($users);
            }

            for ($i = 0; $i < count($users); $i++) {
                $this->mailToNotify = $users[$i]["email"];
                $this->notify($users[$i]["name"], "password");
            }
        } catch (\Throwable $th) {
            Log::error('ImportUsers@handle --- ' . $th->getMessage() . PHP_EOL . $th->getTraceAsString());
            return false;
        }
    }

    /**
     * send email for new users
     */
    private function notify(string $Username, string $Userpass)
    {
        if (!$this->mailToNotify) {
            return;
        }

        $mailable = new ReportFinishMailableImport($Username, $Userpass);

        $mailable->onQueue("emails");


        Mail::to($this->mailToNotify)->queue($mailable);
    }
}
