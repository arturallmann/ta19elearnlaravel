<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        $users = User::all();
        $faker = Factory::create();
        foreach ($posts as $post){
//           $comments = Comment::factory(rand(0,10))->make(['post_id' => $post->id]);
//           foreach ($comments as $comment){
//               $comment->user_id = $users->random()->id;
//               $comment->save();
//           }
            Comment::factory(rand(0,10))->make(['post_id' => $post->id])
                ->each(function ($comment) use ($users, $post, $faker){
                    $comment->user_id = $users->random()->id;
                    $comment->created_at = $faker->dateTimeBetween($post->created_at, 'now');
                    $comment->updated_at = $faker->dateTimeBetween($comment->created_at, 'now');
                    if(rand(0,3)){
                        $comment->updated_at = $comment->created_at;
                    }
                    $comment->save();
                });
        }
    }
}
