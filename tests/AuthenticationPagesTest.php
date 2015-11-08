<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
class AuthenticationPagesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function sign_in_with_invalid_information() {
        $this->visit('auth/login')
            ->type('a', 'email')
            ->type('a', 'password')
            ->press('Sign in')
            ->seeInElement('div.alert.alert-error', 'Invalid')
        ;
    }

    /** @test */
    function sign_in_with_valid_information() {
        $input = factory(App\User::class)->make();
        $user = App\User::create([
            'name' => $input->name,
            'email' => $input->email,
            'password' => bcrypt($input->password),
        ]);
        $this->visit('auth/login')
            ->type($input->email, 'email')
            ->type($input->password, 'password')
            ->press('Sign in')
            ->seePageIs('users/'.$user->id)
            ->see($user->name)
            ->dontSeeLink('Sign in')
            ->seeLink('Sign out', 'auth/logout')
            ->seeLink('Profile', 'users/'.$user->id)
            ;
    }
}
