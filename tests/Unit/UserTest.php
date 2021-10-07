<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    private $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->model = new User();
    }
    /**
     * test Fillable of model
     *
     * @return void
     */
    public function test_fillable_model()
    {
        $expected = [
            "name",
            "email",
            "password",
            "description"
        ];

        $this->assertEquals($expected,$this->model->getFillable());
    }


    public function test_authcontroller_create()
    {
        $userRepository = $this->mock(UserRepositoryContract::class);
        $userRepository->shouldReceive('create')->andReturn(true);
        $this->app->instance(UserRepositoryContract::class, $userRepository);

        $config = [
            "onlyEdit" => false,
            "title" => __("user.text.SignUp"),
            "method" => "POST",
            "route" => route("auth.store")
        ];

        $errors = [];

        $expectedView = view("pages.users.form")->with(compact("config"))->render();


        $this->assertStringContainsString(__("user.text.SigUp"),$expectedView);
    }
}
