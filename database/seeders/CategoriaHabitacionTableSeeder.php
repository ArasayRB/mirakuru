<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaHabitacion;

class CategoriaHabitacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categoria=new CategoriaHabitacion();
      $categoria->category_room='Deluxe';
      $categoria->description='Alto confort';
      $categoria->save();

      $categoria=new CategoriaHabitacion();
      $categoria->category_room='Confort';
      $categoria->description='Confortable';
      $categoria->save();

      $categoria=new CategoriaHabitacion();
      $categoria->category_room='Vip';
      $categoria->description='Alto confort vip';
      $categoria->save();

      $categoria=new CategoriaHabitacion();
      $categoria->category_room='Sencilla';
      $categoria->description='Habitacion con cama personal';
      $categoria->save();

      $categoria=new CategoriaHabitacion();
      $categoria->category_room='Doble';
      $categoria->description='Habitacion con cama camera para dos personas';
      $categoria->save();

      $categoria=new CategoriaHabitacion();
      $categoria->category_room='Doble-Sencilla';
      $categoria->description='Habitacion con 2 camas personales para 2 personas';
      $categoria->save();

      $categoria=new CategoriaHabitacion();
      $categoria->category_room='Triple';
      $categoria->description='Habitacion con camas camera y cama personal para 3 personas';
      $categoria->save();

      $categoria=new CategoriaHabitacion();
      $categoria->category_room='Triple-Sencilla';
      $categoria->description='Habitacion con 3 camas personales para 3 personas';
      $categoria->save();
    }
}
