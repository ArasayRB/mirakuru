<?php

namespace Database\Factories;

use App\Models\Suscripcion;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuscripcionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suscripcion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $gender=array('female','male');
      $randomGender=$this->faker->randomElement($gender);
        return [
          'email' => $this->faker->email,
          'fullName' => $this->faker->name($gender = $randomGender),
        ];
    }
}
