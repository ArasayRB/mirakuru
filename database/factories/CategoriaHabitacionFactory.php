<?php

namespace Database\Factories;

use App\Models\CategoriaHabitacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaHabitacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoriaHabitacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'category_room' => $this->faker->jobTitle,
          'description' => $this->faker->paragraph,
        ];
    }
}
