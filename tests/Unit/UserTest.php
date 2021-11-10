<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
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
            "description",
            "phone"
        ];

        $diff = array_diff($expected, $this->model->getFillable());

        $this->assertEquals(0, count($diff));
    }


    /*public function test_authcontroller_create()
    {
        $userRepository = $this->mock(UserRepositoryContract::class);
        $userRepository->shouldReceive('create')->andReturn(true);
        $this->app->instance(UserRepositoryContract::class, $userRepository);

        $config = [
            "onlyEdit" => false,
            "title" => __("user.text.SignUp"),
            "route" => route("auth.store")
            "method" => "POST",
        ];

        $errors = [];

        $expectedView = view("pages.users.form")->with(compact("config"))->render();


        $this->assertStringContainsString(__("user.text.SigUp"), $expectedView);
    }*/
}
