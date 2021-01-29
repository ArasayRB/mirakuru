<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndiceComentarioHostal;

class IndiceComentarioHostalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $indice=new IndiceComentarioHostal();
      $indice->name='confort';
      $indice->save();

      $indice=new IndiceComentarioHostal();
      $indice->name='limpieza';
      $indice->save();

      $indice=new IndiceComentarioHostal();
      $indice->name='ubicación';
      $indice->save();

      $indice=new IndiceComentarioHostal();
      $indice->name='servicios';
      $indice->save();

      $indice=new IndiceComentarioHostal();
      $indice->name='hosters_atention';
      $indice->save();
    }
}
