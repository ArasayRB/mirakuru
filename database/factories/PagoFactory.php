<?php

namespace Database\Factories;

use App\Models\Hostal;
use App\Models\Pago;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pago::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $cantUser=User::all()->count();
      $cantHostal=Hostal::all()->count();
      $cantReserva=Reserva::all()->count();
      $stringPartial='null';
      $arrayPartials=array('20.08','405','33.09');
      for($i=0;$i<count($arrayPartials);$i++){
        $randomPartial=$this->faker->randomElement($arrayPartials);
        if($stringPartial=='null'){
          $stringPartial="".$randomPartial;
        }
        else{
          $stringPartial="".$stringPartial."-".$randomPartial;
        }
      }

        return [
          'user_id' => $this->faker->numberBetween(1,$cantUser),
          'hostal_id' => $this->faker->numberBetween(1,$cantHostal),
          'reserva_id' => $this->faker->numberBetween(1,$cantReserva),
          'partials' => $stringPartial,
          'payed_amount' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 3000),
          'date_payed' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
