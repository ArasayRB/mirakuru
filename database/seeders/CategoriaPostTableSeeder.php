<?php

namespace Database\Seeders;

use App\Models\CategoriaPost;
use Illuminate\Database\Seeder;

class CategoriaPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categoria=new CategoriaPost();
      $categoria->category_post='Comidas';
      $categoria->description='Habla sobre los diferentes tipos de comida que puedes encontrar en nuestro país';
      $categoria->save();

      $categoria=new CategoriaPost();
      $categoria->category_post='Excursiones';
      $categoria->description='Habla sobre todas las excursiones que puedes realizar en  nuestra ciudad';
      $categoria->save();

      $categoria=new CategoriaPost();
      $categoria->category_post='Vida y Ocio';
      $categoria->description='Habla sobre cultura y forma de vida de nuestra ciudad';
      $categoria->save();
    }
}
