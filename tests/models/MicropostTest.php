<?php

use App\User;
use App\Micropost;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MicropostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function micropost_associations() {

        /** @var App\User $user */
        $user = factory(User::class)->create();
        $now = Carbon::now();
        $older_micropost = $user->microposts()->create(['content' => 'Lorem ipsum', 'created_at' => $now->subDay(1)])->toArray();
        $newer_micropost = $user->microposts()->create(['content' => 'Lorem ipsum', 'created_at' => $now->subHour(1)])->toArray();
        $microposts = $user->microposts->toArray();
        $this->assertEquals([ $newer_micropost, $older_micropost ], $microposts);

        $user->delete();
        foreach ($microposts as $micropost) {
            $this->assertNull(Micropost::find($micropost['id']));
        }
        $this->assertEquals(0, $user->microposts()->count());
    }
}
