<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * create user success
     */
    public function test_create_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/create")
                ->type("[name='name']", "UserTest")
                ->type("[name='email']", "test@gmail.com")
                ->type("[name='password']", "password")
                ->type("[name='password_confirmation']", "password")
                ->click("#btn-register")->waitForText(__("user.text.Login"), 5)
                ->assertSee(__("user.text.Login"));
        });
    }
    /**
     * login fail
     *
     * @return void
     */
    public function test_login_fail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type("email", "fulano@gmail.com")
                ->type("password", "147852369")
                ->click("#btn-login")
                ->assertSee(__("auth.failed"));
        });
    }

    /**
     * login success
     *
     * @return void
     */
    public function test_login_success()
    {
        $email = "jorgecalheiros.s@gmail.com";

        $user = User::where('email', $email)->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->type("email", "jorgecalheiros.s@gmail.com")
                ->type("password", "147852369")
                ->click("#btn-login")
                ->assertSee($user->name);
        });
    }

    /**
     * create post
     */
    public function create_post()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/posts")
                ->click("#btn_create_post")
                ->type("[name='title']", "Title test Dusk")
                ->type("p", "Lorem lorem lorem dusk lorem lorem lorem")
                ->click("#savePost")
                ->assertTitle("Posts");
        });
    }

    /**
     * view post
     */
    public function test_view_post()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/posts")
                ->click(".actClickPost")
                ->assertSee(__("misc.button.edit"))
                ->assertSee(__("misc.button.delete"));
        });
    }

    /**
     * update post
     */
    public function test_update_post()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/posts")
                ->click(".actClickPost")
                ->assertSee(__("misc.button.edit"))
                ->click("#update-post")
                ->assertSee(__("post.text.title.edit"))
                ->assertTitle(__("post.text.title.edit"))
                ->type("[name='title']", "Title test Dusk Edit")
                ->type("p", "Lorem lorem lorem dusk lorem lorem lorem Edit")
                ->click("#savePost")->waitForText(__("misc.button.edit"), 5)
                ->assertSee(__("misc.button.edit"));
        });
    }

    /**
     * delete post
     */
    public function test_delete_post()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/posts")
                ->click(".actClickPost")
                ->assertSee(__("misc.button.delete"))
                ->click("#btn-delete-post")
                ->click("#delete-with-sure")
                ->assertTitle("Posts");
        });
    }

    /**
     * logout
     *
     * @return void
     */
    public function test_logout()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/posts")
                ->click("#cursor_pointer")
                ->click("#logout")
                ->assertSee(__("user.text.Login"));
        });
    }
}
