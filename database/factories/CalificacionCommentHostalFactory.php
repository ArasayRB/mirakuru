<?php

namespace Database\Factories;

use App\Models\CalificacionCommentHostal;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalificacionCommentHostalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CalificacionCommentHostal::class;

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
