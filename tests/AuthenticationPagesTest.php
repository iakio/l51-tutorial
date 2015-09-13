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
        ;
        $this->assertContains('Invalid', $this->crawler->filter('div.alert.alert-error')->text());
    }

    /** @test */
    function sign_in_with_valid_information() {
        $user = factory(App\User::class)->make();
        App\User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => bcrypt($user->password),
        ]);
        $this->visit('auth/login')
            ->type($user->email, 'email')
            ->type($user->password, 'password')
            ->press('Sign in')
            ->see($user->name);
    }
}
