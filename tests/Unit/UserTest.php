<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_view_users_controller()
    {
        $users = User::factory(2)->make()->all();
        $expectedView = view('pages.users.index', compact('users'))->render();
    }
}
