<?php

namespace Database\Factories;

use App\Models\Cash;
use App\Models\Cuenta;
use App\Models\TipoCuenta;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CuentaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cuenta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $cantUser=User::all()->count();
      $cantCash=Cash::all()->count();
      $cantTipCuenta=TipoCuenta::all()->count();
        return [
            'type_account' => $this->faker->numberBetween(1,$cantTipCuenta),
            'numberaccount' => $this->faker->creditCardNumber,
            'user_id' => $this->faker->numberBetween(1,$cantUser),
            'amount' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
            'cash_id' => $this->faker->numberBetween(1,$cantCash),
          ];
    }
}
