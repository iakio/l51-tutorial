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

    /** @test */
    function sign_up_with_invalid_information() {
        $this->visit('auth/register')
            ->submitForm('Create my account');
        $this->assertEquals(0, App\User::count());
    }

    /** @test */
    function sign_up_with_valid_information() {
        $this->visit('auth/register')
            ->type('Example User', 'name')
            ->type('user@example.com', 'email')
            ->type('foobar', 'password')
            ->type('foobar', 'password_confirmation')
            ->press('Create my account');
        $this->assertEquals(1, App\User::count());
        $this->assertContains('Welcome', $this->crawler->filter('div.alert.alert-success')->text());
    }
}
