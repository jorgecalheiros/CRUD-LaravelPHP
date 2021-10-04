<?php

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function test_views_post_when_user_not_login()
    {
        $response = $this->get(route("posts.index", 1));

        $response->assertStatus(302);

    }

    /**
     * @return void
     */
    public function test_views_post_when_user_login()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route("posts.index", 1));

        $response->assertStatus(200);

    }

    /**
     * @return void
     */

    public function test_views_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route("posts.create",1));
        $response->assertStatus(200);
        $this->assertEquals(false, $response->viewData("config")["onlyEdit"]);
        $this->assertEquals("POST", $response->viewData("config")["method"]);
    }

    /**
     * @return void
     */

    public function test_views_update_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route("posts.edit",1));
        $response->assertStatus(200);
        $this->assertEquals(true, $response->viewData("config")["onlyEdit"]);
        $this->assertEquals("PUT", $response->viewData("config")["_method"]);
    }

    /**
     * @return void
     */
    public function test_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route("posts.store"), [
            "user_id" => $user->id,
            "title" => "Rem",
            "content" => "Lorem imposun",
        ]);
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_update_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->put(route("posts.update", 1), [
            "user_id" => $user->id,
            "title" => "Rem",
            "content" => "Lorem",
        ]);
        $response->assertStatus(302);
    }
}
