<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $articles_id = DB::table('articles')->pluck('id')->toArray();
        $users_id = DB::table('users')->pluck('id')->toArray();

        return [
            'comment' => fake()->text(50),
            'article_id' => fake()->randomElement($articles_id),
            'user_id' => fake()->randomElement($users_id),
        ];
    }
}
