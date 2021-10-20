<?php

namespace App\Jobs;

use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $filePath;
    private const NAME_COL = 1;
    private const EMAIL_COL = 2;
    private const DESCRIPTION_COL = 6;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
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

        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($dataCols = fgetcsv($handle, 0, ",")) !== FALSE) {
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
            User::insert($users);
        }
    }
}
