<?php
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    function with_admin_attribute_set_to_true()
    {
        $user = User::create([
            'name' => 'Example User',
            'email' => 'user@example.com',
            'password' => bcrypt('foobar')
        ]);
        $user = $user->fresh();
        $this->assertFalse($user->admin);
    }

    /** @test */
    function follow_and_unfollow()
    {
        /** @var App\User $user1 */
        /** @var App\User $user2 */
        $user1 = factory(App\User::class)->create();
        $user2 = factory(App\User::class)->create();
        $this->assertEquals(0, $user1->followers()->count());

        $user1->follow($user2);
        $this->assertTrue($user1->isFollowing($user2));
        $this->assertTrue($user2->followers->contains($user1));
        $this->assertTrue($user1->followed_users->contains($user2));

        $user1->unfollow($user2);
        $this->assertFalse($user1->isFollowing($user2));
        $this->assertFalse($user2->fresh()->followers->contains($user1));
        $this->assertFalse($user1->fresh()->followed_users->contains($user2));
    }

    /** @test */
    function feed()
    {
        /** @var App\User $user */
        $user = factory(App\User::class)->create();
        $unfollowed_user = factory(App\User::class)->create();
        $followed_user = factory(App\User::class)->create();
        $unfollowed_feed = factory(App\Micropost::class)->create(['user_id' => $unfollowed_user->id]);
        $followed_feed = factory(App\Micropost::class)->create(['user_id' => $followed_user->id]);
        $user->follow($followed_user);

        $this->assertTrue($user->feed()->get()->contains($followed_feed));
        $this->assertFalse($user->feed()->get()->contains($unfollowed_feed));
    }
}
