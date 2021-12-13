<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $created = $this->faker->dateTimeBetween('-10 years', 'now');
        $updated = $this->faker->dateTimeBetween($created, 'now');
        if(rand(0,3)){
            $updated = $created;
        }
        return [
            'body' => $this->faker->sentence,
            'created_at' => $created,
            'updated_at' => $updated
        ];
    }
}
