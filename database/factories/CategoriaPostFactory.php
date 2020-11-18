<?php

namespace Database\Factories;

use App\Models\CategoriaPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoriaPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'category_post' => $this->faker->jobTitle,
          'description' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        ];
    }
}
