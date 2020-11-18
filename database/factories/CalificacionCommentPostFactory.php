<?php

namespace Database\Factories;

use App\Models\CalificacionCommentPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalificacionCommentPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CalificacionCommentPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'calification' => $this->faker->word,
          'description' => $this->faker->paragraph,
          'img_url' => $this->faker->url,
        ];
    }
}
