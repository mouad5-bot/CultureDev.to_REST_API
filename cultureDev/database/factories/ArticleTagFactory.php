<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleTag>
 */
class ArticleTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $articles_id = DB::table('articles')->pluck('id')->toArray();
        $tags_id = DB::table('tags')->pluck('id')->toArray();
        return [
            'article_id' => fake()->randomElement($articles_id),
            'tag_id' => fake()->randomElement($tags_id),
        ];
    }
}
