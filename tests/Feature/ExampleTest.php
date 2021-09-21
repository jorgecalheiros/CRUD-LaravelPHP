<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/users/');
        $response->assertStatus(200);
    }
}
