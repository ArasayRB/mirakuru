<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Habitacion;

class HabitacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $habitacion=new Habitacion();
      $habitacion->name='Habitacion Azul';
      $habitacion->price_high=25.70;
      $habitacion->price_low=20;
      $habitacion->capacity=3;
      $habitacion->active=true;
      $habitacion->hostal_id=1;
      $habitacion->category_id=1;
      $habitacion->save();

      $habitacion=new Habitacion();
      $habitacion->name='Habitacion Verde';
      $habitacion->price_high=28;
      $habitacion->price_low=22.50;
      $habitacion->capacity=3;
      $habitacion->active=true;
      $habitacion->hostal_id=1;
      $habitacion->category_id=2;
      $habitacion->save();
    }
}
