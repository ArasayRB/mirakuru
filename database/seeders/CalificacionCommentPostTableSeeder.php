<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CalificacionCommentPost;

class CalificacionCommentPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $calificacion=new CalificacionCommentPost();
      $calificacion->calification='5';
      $calificacion->description='Post con excelente calificación, buena redacción del texto, tema interesante, proporciona excelente información, proporciona buens referencias, proporciona autenticidad y buenos ejemplos';
      $calificacion->save();

      $calificacion=new CalificacionCommentPost();
      $calificacion->calification='4';
      $calificacion->description='Post con buena calificación pero con algún problema en uno de los siguientes aspectos:  buena redacción del texto, tema interesante, proporciona excelente información, proporciona buens referencias, proporciona autenticidad y buenos ejemplos';
      $calificacion->save();

      $calificacion=new CalificacionCommentPost();
      $calificacion->calification='3';
      $calificacion->description='Post con aceptable calificación presentando problemas en varios de los siguientes aspectos:  buena redacción del texto, tema interesante, proporciona excelente información, proporciona buens referencias, proporciona autenticidad y buenos ejemplos';
      $calificacion->save();

      $calificacion=new CalificacionCommentPost();
      $calificacion->calification='2';
      $calificacion->description='Post con mala calificación mostrando serios problemas en uno o muchos de estos aspectos:  buena redacción del texto, tema interesante, proporciona excelente información, proporciona buens referencias, proporciona autenticidad y buenos ejemplos';
      $calificacion->save();

      $calificacion=new CalificacionCommentPost();
      $calificacion->calification='1';
      $calificacion->description='Post con pèsima calificación faltándole criterios aceptables en todos los aspectos siguientes:  buena redacción del texto, tema interesante, proporciona excelente información, proporciona buens referencias, proporciona autenticidad y buenos ejemplos';
      $calificacion->save();
    }
}
