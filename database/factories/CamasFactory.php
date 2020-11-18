<?php

namespace Database\Factories;

use App\Models\Camas;
use Illuminate\Database\Eloquent\Factories\Factory;

class CamasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Camas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'type_bed' => $this->faker->word,
          'capacity' => $this->faker->numberBetween($min = 1, $max = 3) ,
        ];
    }
}
