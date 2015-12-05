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

        User::all()->take(6)->each(function (User $user) {
            $user->microposts()->saveMany(
                factory(Micropost::class, 50)->make()
            );
        });

        Model::reguard();
    }
}
