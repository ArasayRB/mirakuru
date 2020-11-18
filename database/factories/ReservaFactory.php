<?php

namespace Database\Factories;

use App\Models\Hostal;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reserva::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $cantHostal=Hostal::all()->count();
      $cantUser=User::all()->count();
      $cantServ=Servicio::all()->count();


        return [
          'date_in' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
          'date_out' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
          'user_id' => $this->faker->numberBetween(1,$cantUser),
          'totally_persons' => $this->faker->numberBetween(1,8),
          'child' => $this->faker->numberBetween(1,3),
          'service' => $this->faker->numberBetween(1,$cantServ),
          'active' => $this->faker->boolean,
          'amount' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 30000),
          'hostal_id' => $this->faker->numberBetween(1,$cantHostal),
        ];
    }
}
