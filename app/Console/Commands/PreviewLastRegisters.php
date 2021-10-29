<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PreviewLastRegisters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:preview-last-registers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Preview 5 last registers';

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
        $name = $this->ask("Digite o nome ?");
        if (!$this->confirm("Deseja continuar ?")) {
            $this->info("Cancelado");
            exit;
        }
        $this->info($name);
        $year = $this->choice("Quantos anos você tem?", ["14", "15", "16", "17", "20"], 14);
        $this->info($year);
        $bar = $this->output->createProgressBar(10);
        $bar->start();
        for ($i = 0; $i < 9; $i++) {
            $bar->advance();
            sleep(1);
        }
        $bar->finish();
        $this->table(["name", "year"], [[$name, $year]]);
        return Command::SUCCESS;
    }
}
