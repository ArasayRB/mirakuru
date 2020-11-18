<?php

namespace Database\Factories;

use App\Models\CategoriaHabitacion;
use App\Models\Habitacion;
use App\Models\Hostal;
use Illuminate\Database\Eloquent\Factories\Factory;

class HabitacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Habitacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $cantHostal=Hostal::all()->count();
      $cantCateg=CategoriaHabitacion::all()->count();
        return [
          'name' => $this->faker->jobTitle,
          'price_high' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 500),
          'price_low' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 200),
          'active' => $this->faker->boolean,
          'hostal_id' => $this->faker->numberBetween(1,$cantHostal),
          'category_id' => $this->faker->numberBetween(1,$cantCateg),
        ];
    }
}
