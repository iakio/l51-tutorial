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
        $user = App\User::where('email', 'user@example.com')->firstOrFail();
        $this
            ->seeLink('Sign out', 'auth/logout')
            ->seeInElement('title', $user->name)
            ->seeInElement('div.alert.alert-success', 'Welcome');
    }

    /** @test */
    function edit_page_with_invalid_information() {
        $user = factory(App\User::class)->create();
        $this->actingAs($user)
            ->visit(action('UsersController@edit', $user->id))
            ->see('Update your profile')
            ->seeInElement('title', 'Edit user')
            ->seeLink('change', 'http://gravatar.com/emails')
            ->press('Save changes')
            ->see('error')
            ;
    }

    /** @test */
    function edit_page_with_valid_information() {
        $user = factory(App\User::class)->create();
        $new_name = 'New Name';
        $this->actingAs($user)
            ->visit(action('UsersController@edit', $user->id))
            ->type($new_name, 'name')
            ->type($user->password, 'password')
            ->type($user->password, 'password_confirmation')
            ->press('Save changes')
            ->seeInElement('title', $new_name)
            ->seeInElement('div.alert.alert-success', 'updated')
            ->seeLink('Sign out', 'auth/logout')
            ;
        $this->assertEquals($new_name, $user->fresh()->name);
    }

    /** @test */
    function index_page_should_list_each_user() {
        factory(App\User::class, 30)->create();
        $user = factory(App\User::class)->create();
        $this->actingAs($user)
            ->visit(action('UsersController@index'))
            ->seeInElement('title', 'All users')
            ;
        App\User::paginate(30)->each(function ($user) {
            $this->see($user->name);
        });
    }

    /** @test  */
    function index_page_should_have_delete_link_if_admin() {
        factory(App\User::class, 30)->create();
        $user = factory(App\User::class)->create();
        $this->actingAs($user)
            ->visit(action('UsersController@index'))
            ->dontSeeLink('delete')
            ;
        $admin = factory(App\User::class, 'admin')->create();
        $this->actingAs($admin)
            ->visit(action('UsersController@index'))
            ->seeLink('delete')
         ;
    }
}
