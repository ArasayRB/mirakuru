<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CalificacionCommentHostal;

class CalificacionCommentHostalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $calificacion=new CalificacionCommentHostal();
      $calificacion->calification='5';
      $calificacion->description='Hostal con excelente calificación, buena ubicación, buen servicio, buen trato, buen confort, buena limpieza';
      $calificacion->save();

      $calificacion=new CalificacionCommentHostal();
      $calificacion->calification='4';
      $calificacion->description='Hostal con buena calificación pero con algún problema en uno de los siguientes aspectos: buena ubicación, buen servicio, buen trato, buen confort, buena limpieza';
      $calificacion->save();

      $calificacion=new CalificacionCommentHostal();
      $calificacion->calification='3';
      $calificacion->description='Hostal con aceptable calificación presentando problemas en varios de los siguientes aspectos: buena ubicación, buen servicio, buen trato, buen confort, buena limpieza';
      $calificacion->save();

      $calificacion=new CalificacionCommentHostal();
      $calificacion->calification='2';
      $calificacion->description='Hostal con mala calificación mostrando serios problemas en uno o muchos de estos aspectos: buena ubicación, buen servicio, buen trato, buen confort, buena limpieza';
      $calificacion->save();

      $calificacion=new CalificacionCommentHostal();
      $calificacion->calification='1';
      $calificacion->description='Hostal con pèsima calificación faltándole criterios aceptables en todos los aspectos siguientes: buena ubicación, buen servicio, buen trato, buen confort, buena limpieza';
      $calificacion->save();
    }
}
