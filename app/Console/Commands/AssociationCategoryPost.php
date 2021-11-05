<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AssociationCategoryPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:association-category-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Association category with posts';

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
            $id_post = $this->ask("Qual é o id do posts? ");

            $title_category = $this->ask("Qual é o titulo da categoria? ");

            $association = DB::table('category_post')->get();

            $this->info($association->collect());
        } catch (\Throwable $th) {
            $this->error('Command error' . $th->getMessage());
        }
        return Command::SUCCESS;
    }
}
