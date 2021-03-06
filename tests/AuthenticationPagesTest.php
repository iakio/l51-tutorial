<?php
use App\User;

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

    function createUser($input) {
        return User::create([
            'name' => $input->name,
            'email' => $input->email,
            'password' => bcrypt($input->password),
        ]);
    }

    /** @test */
    function sign_in_with_valid_information() {
        $input = factory(User::class)->make();
        $user = $this->createUser($input);
        $this->visit('auth/login')
            ->type($input->email, 'email')
            ->type($input->password, 'password')
            ->press('Sign in')
            ->seePageIs('user/'.$user->id)
            ->see($user->name)
            ->dontSeeLink('Sign in')
            ->seeLink('Sign out', 'auth/logout')
            ->seeLink('Users', 'user/')
            ->seeLink('Profile', 'user/'.$user->id)
            ->seeLink('Settings', 'user/'.$user->id.'/edit')
            ;
    }

    /** @test */
    function non_signed_in_user_visiting_the_edit_page() {
        $user = factory(User::class)->create();
        $this->visit(action('UsersController@edit', $user->id))
            ->seeInElement('title', 'Sign in')
            ;
    }

    /** @test */
    function non_signed_in_user_submitting_to_the_update_action() {
        $user = factory(User::class)->create();
        $this->call('post', action('UsersController@update', $user->id));
        //$this->assertRedirectedTo('auth/login');
        $this->assertResponseStatus(500);
    }

    /** @test */
    function wrong_user_visiting_the_edit_page() {
        $user = factory(User::class)->create();
        $wrong_user = factory(User::class)->create();
        $this->actingAs($user)
            ->call('get', action('UsersController@edit', $wrong_user->id))
        ;
        $this->assertRedirectedTo('/');
    }

    /** @test */
    function wrong_user_submitting_to_the_update_action() {
        $user = factory(User::class)->create();
        $wrong_user = factory(User::class)->create();
        $this->actingAs($user)
            ->call('post', action('UsersController@update', $wrong_user->id));
        ;
        //$this->assertRedirectedTo('/');
        $this->assertResponseStatus(500);
    }

    /** @test */
    function friendly_forwarding() {
        $input = factory(User::class)->make();
        $user = $this->createUser($input);
        $this->visit(action('UsersController@edit', $user->id))
            ->type($input->email, 'email')
            ->type($input->password, 'password')
            ->press('Sign in')
            ->seePageIs(action('UsersController@edit', $user->id))
            ->seeInElement('title', 'Edit user')
            ;
    }

    /** @test */
    function non_signed_in_user_visiting_the_user_index() {
        $input = factory(User::class)->make();
        $user = $this->createUser($input);

        $this->visit(action('UsersController@index'))
            ->see('Sign in')
            ;
    }

    /** @test */
    function non_admin_user_submitting_a_delete_request()
    {
        $user = factory(User::class)->create();
        $non_admin = factory(User::class)->create();
        $this->actingAs($non_admin)
            ->visit(action('UsersController@index'))
            ->makeRequest('delete', action('UsersController@destroy', $user->id), [
                '_token' => csrf_token()
            ])
            ->seePageIs('/');
    }


    /** @test */
    function non_sign_in_user_submitting_to_the_create_action()
    {
        $this->visit('/')
            ->makeRequest('post', action('MicropostsController@store'), ['_token' => csrf_token(), 'content' => 'Lorem'])
            ->see('Sign in');
    }

    /** @test */
    function non_sign_in_user_submitting_to_the_destroy_action()
    {
        $user = factory(User::class)->create();
        $micropost = $user->microposts()->save(factory(App\Micropost::class)->make());
        $this->visit('/')
            ->makeRequest('delete', action('MicropostsController@destroy', $micropost->id), ['_token' => csrf_token()])
            ->see('Sign in');
    }
}
