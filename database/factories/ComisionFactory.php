<?php

namespace Database\Factories;

use App\Models\Comision;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComisionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comision::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'name_comission' => $this->faker->word,
          'amount_porcent' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 40) ,
        ];
    }
}
