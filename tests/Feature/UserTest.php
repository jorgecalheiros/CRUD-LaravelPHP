<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $userRepository = $this->mock(UserRepositoryContract::class);
        $userRepository->shouldReceive('create')->andReturn(true);
        $this->app->instance(UserRepositoryContract::class, $userRepository);
    }


    /**
     * @return void
     */
    public function test_view_one_users()
    {
        $response = $this->get("/users/1");
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_view_users()
    {
        $response = $this->get("/users");
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_redirect_to_login()
    {
        $response = $this->get("/users");
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_view_login()
    {
        $response = $this->get("/login");
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_view_create()
    {
        $response = $this->get("/create");
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_view_update()
    {
        $response = $this->get("/users/1/edit");
        $response->assertStatus(302);
    }


    /**
     * @return void
     */
    public function test_create_user()
    {
        $response = $this->post("store", [
            "name" => "tstes",
            "email" => "teste@gmail.com",
            "password" => 12345678
        ]);
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_login_user()
    {
        $response = $this->post("/authenticate", [
            "email" => "teste@gmail.com",
            "password" => 12345678
        ]);

        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_update_user()
    {
        $response = $this->put("/users/1", [
            "name" => "tstes",
            "email" => "teste@gmail.com",
            "password" => 12345678
        ]);
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_delete_user()
    {
        $response = $this->delete("/users/1");
        $response->assertStatus(302);
    }
}
