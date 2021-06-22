<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Camas;

class CamasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categoria=new Camas();
      $categoria->type_bed='Personal';
      $categoria->capacity=1;
      $categoria->save();

      $categoria=new Camas();
      $categoria->type_bed='Doble';
      $categoria->capacity=2;
      $categoria->save();

      $categoria=new Camas();
      $categoria->type_bed='King-size';
      $categoria->capacity=2;
      $categoria->save();
    }
}
