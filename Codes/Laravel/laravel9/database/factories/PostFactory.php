<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $title = fake()->realText(rand(10,40));
        $short_title = mb_strlen($title) > 30 ? mb_substr($title, 0, 30) . '...' : $title;
        $create = fake()->dateTimeBetween('-30 days', '-1 days');
        return [
            'title' => $short_title,
            'short_title' => $short_title,
            'author_id' => rand(1,4),
            'descr' => fake()->realText(rand(100,500)),
            'created_at' => $create,
            'updated_at' => $create,
        ];
    }
}
