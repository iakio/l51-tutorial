<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Micropost;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(User::class)->create([
            'name'     => 'Example User',
            'email'    => 'example@railstutorial.jp',
            'password' => bcrypt('foobar'),
            'admin'    => true
        ]);
        factory(User::class, 99)->make()->each(function(User $user, $i) {
            $user->save([
                'email' => "example-{$i}@railstutorial.jp",
                'password' => bcrypt('password'),
            ]);
        });

        $this->makeMicroposts();

        $users = User::all();
        $user = $users->first();
        $followed_users = $users->slice(2, 50);
        $followers = $users->slice(3, 40);
        $followed_users->each(function ($followed) use ($user) {
            $user->follow($followed);
        });
        $followers->each(function ($follower) use ($user) {
            $follower->follow($user);
        });

        Model::reguard();
    }

    public function makeMicroposts()
    {
        User::all()->take(6)->each(function (User $user) {
            $user->microposts()->saveMany(
                factory(Micropost::class, 50)->make()
            );
        });
    }
}
