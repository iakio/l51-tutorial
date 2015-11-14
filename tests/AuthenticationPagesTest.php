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
            ->seeLink('Settings', 'users/'.$user->id.'/edit')
            ;
    }

    /** @test */
    function non_signed_in_user_visiting_the_edit_page() {
        $user = factory(App\User::class)->create();
        $this->visit(action('UsersController@edit', $user->id))
            ->seeInElement('title', 'Sign in')
            ;
    }

    /** @test */
    function non_signed_in_user_submitting_to_the_update_action() {
        $user = factory(App\User::class)->create();
        $this->call('post', action('UsersController@update', $user->id));
        $this->assertResponseStatus(500);
        //$this->assertRedirectedTo('auth/login');
    }
}
