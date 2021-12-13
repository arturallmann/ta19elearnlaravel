<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = env('USER_DEFAULT_NAME', 'User');
        $user->email = env('USER_DEFAULT_EMAIL', 'user@user.user');
        $user->password = bcrypt(env('USER_DEFAULT_PASSWORD', 'password'));
        $user->save();

        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(TagSeeder::class);

    }
}
