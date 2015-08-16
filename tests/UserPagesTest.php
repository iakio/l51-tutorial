<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserPagesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function profile_page_have_contents() {
        /** @var \App\User $user */
        $user = factory(App\User::class)->create();
        $this->visit('users/' . $user->id)
            ->see($user->name);
    }

    /** @test */
    function sign_up_page_have_contents_Sign_Up() {
        $this->visit('auth/register')
            ->see("Sign Up");
    }
}
