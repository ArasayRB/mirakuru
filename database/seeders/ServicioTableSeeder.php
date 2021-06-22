<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categoria=new Servicio();
      $categoria->name='Desayuno Completo';
      $categoria->description='Desayuno que incluye café, pan, mantequilla, jugo de frutas naturales, huevos(tortilla/omelet, frito, hervido), dulces criollos, mermelada, leche, té, plato de frutas naturales';
      $categoria->price_high=5.00;
      $categoria->price_low=4;
      $categoria->name_contact='Dueño Hostal';
      $categoria->person_min=1;
      $categoria->person_max=1;
      $categoria->save();
      $categoria->hostales()->attach(1);
      $categoria->hostales()->attach(2);

      $categoria=new Servicio();
      $categoria->name='Desayuno Sencillo';
      $categoria->description='Desayuno que incluye café, pan, mantequilla';
      $categoria->price_high=2.00;
      $categoria->price_low=2;
      $categoria->name_contact='Dueño Hostal';
      $categoria->person_min=1;
      $categoria->person_max=1;
      $categoria->save();
      $categoria->hostales()->attach(1);
      $categoria->hostales()->attach(2);

      $categoria=new Servicio();
      $categoria->name='Desayuno Normal';
      $categoria->description='Desayuno que incluye café con leche ó jugo, pan, mantequilla';
      $categoria->price_high=2.70;
      $categoria->price_low=2.70;
      $categoria->name_contact='Dueño Hostal';
      $categoria->person_min=1;
      $categoria->person_max=1;
      $categoria->save();
      $categoria->hostales()->attach(1);
      $categoria->hostales()->attach(2);
    }
}
