<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MicropostPageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function create_with_invalid_information()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user)
            ->visit('/')
            ->press('Post')
            ->see('error')
            ->assertEquals(0, $user->microposts()->count());
    }

    /** @test */
    function create_with_valid_information()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user)
            ->visit('/')
            ->type('Lorem ipsum', 'content')
            ->press('Post')
            ->assertEquals(1, $user->microposts()->count());
    }
    
}
