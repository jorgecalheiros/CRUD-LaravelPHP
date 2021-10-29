<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Str;

class TableRegisters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            if (!$table = $this->ask("Digite o nome da tabela")) {
                exit;
            };

            $model = $this->getModel($table);
            $registers = $model->orderBy('id', 'DESC')->limit(5)->get();
            $headers = $this->getHeaders($registers);
            $rows = $this->getRows($registers, $headers);

            $this->table($headers, $rows);
        } catch (\Throwable $th) {
            $this->error('Command error' . $th->getMessage());
        }
    }

    private function getModel($table)
    {
        $model = "App\\Models\\" . Str::studly(Str::singular($table));

        if (!class_exists($model)) {
            throw new Exception("Model not found: $model");
        }

        return new  $model;
    }
    /**
     * Return only allowed fields (exclude hidden fields)
     *
     * @param Collection $registers
     * @return array
     */
    private function getHeaders($registers): array
    {
        $attr = $registers->first()->getAttributes();
        $hiddenFilds = $registers->first()->getHidden();
        return array_diff(array_keys($attr), $hiddenFilds);
    }

    /**
     *Extract registers rows from allowed headers (fields)
     * @param Collection $registers
     * @param array $headers
     * @return array
     */
    private function getRows($registers, array $headers)
    {
        $rows = [];

        foreach ($registers as $register) {
            $attr = $register->getAttributes();
            $rows[] = collect($attr)->only($headers)->toArray();
        }
        return $rows;
    }
}
