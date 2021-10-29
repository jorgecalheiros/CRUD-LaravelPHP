<?php

namespace App\Console\Commands;

use App\Http\Controllers\AdminController;
use App\Repositories\Contracts\UserRepositoryContract;
use Exception;
use Illuminate\Console\Command;
use Validator;

class CreateUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:create-user-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User Admin';

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
            $data = [
                "name" => $name = $this->ask("Digite o seu nome: "),
                "email" => $email = $this->ask("Digite seu email: "),
                "password" => $password = $this->ask("Insira uma senha: ")
            ];

            if (!$name || !$email || !$password) {
                exit;
            }

            $validator = Validator::make($data, [
                "email" => 'required|unique:users'
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->getMessageBag());
            }

            if (!$this->confirm("Deseja continuar? ")) {
                $this->info("Cancelado");
                exit;
            }


            $repository = app(UserRepositoryContract::class);
            $controller = new AdminController($repository);
            $this->info($controller->store(
                [
                    "name" => $name,
                    "email" => $email,
                    "password" => $password
                ]
            ));
        } catch (\Throwable $th) {
            $this->error("Command error" . $th->getMessage());
        }
    }
}
