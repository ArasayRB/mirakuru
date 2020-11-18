<?php

namespace Database\Factories;

use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Servicio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $gender=array('female','male');
      $firstName=$this->faker->firstName($gender);
      $lastName=$this->faker->lastName;
      $fullName="".$firstName." ".$lastName;
        return [
          'name' => $this->faker->jobTitle,
          'description' => $this->faker->text,
          'price_high' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 500),
          'price_low' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 200),
          'name_contact' => $fullName,
          'person_min' => $this->faker->numberBetween(1,8),
          'person_max' => $this->faker->numberBetween(1,2),
        ];
    }
}
