<?php

namespace Tests\Feature;

use App\Models\User;
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
    public function test_view_one_users_when_user_not_login()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route("users.index", 1));

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_view_one_users()
    {
        $response = $this->get(route("users.index", 1));
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_view_users()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route("users.index"));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_view_users_when_user_not_login()
    {
        $response = $this->get(route("users.index"));
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_redirect_to_login()
    {
        $response = $this->get(route("users.index"));
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_view_login()
    {
        $response = $this->get(route("auth.login"));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_view_create()
    {
        $response = $this->get(route("auth.create"));
        $response->assertSee("name=\"reppassword\"", false);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_view_update()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route("users.edit", 1));
        $response->assertDontSee("name=\"reppassword\"");
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_view_update_when_user_not_login()
    {
        $response = $this->get(route("users.edit", 1));
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_create_user()
    {
        $response = $this->post(route("auth.store"), [
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
        $response = $this->post(route("auth.auth"), [
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
        $response = $this->put(route("users.update", 1), [
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
        $response = $this->delete(route("users.destroy", 1));
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_logout_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route("auth.logout"));
        $response->assertStatus(302);
    }
}
