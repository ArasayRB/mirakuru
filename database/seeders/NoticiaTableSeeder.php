<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TemaNoticia;
use App\Models\Noticia;
use Illuminate\Support\Str;

class NoticiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $temas=TemaNoticia::all();
        $noticia=new Noticia();
        $noticia->title="Conozca las 4 polémicas de la vida de Alicia Keys";
        $noticia->noticia="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        $noticia->description="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut ";
        $noticia->publicate_state=1;
        $noticia->cant_access_read=8;
        $noticia->cant_likes=4;
        $noticia->tema_id=3;
        $noticia->hostal_id=1;
        $noticia->user_id=1;
        $noticia->tags="empoderamiento femenino,moda y belleza,noticias";
        $noticia->slug=Str::slug($noticia->title, '-');
        $noticia->keywords="empoderamiento femenino,alicia keys,noticias";
        $noticia->save();

        $noticia=new Noticia();
        $noticia->title="10 Cosas que debe conocer antes de viajar a Cuba sobre COVID-19";
        $noticia->noticia="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        $noticia->description="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut ";
        $noticia->publicate_state=1;
        $noticia->cant_access_read=13;
        $noticia->cant_likes=1;
        $noticia->cant_shares=4;
        $noticia->tema_id=1;
        $noticia->hostal_id=1;
        $noticia->user_id=4;
        $noticia->tags="covid 19,cuba viajes,turismo";
        $noticia->slug=Str::slug($noticia->title, '-');
        $noticia->keywords="covid 19,turismo en cuba,noticias";
        $noticia->save();

        $noticia=new Noticia();
        $noticia->title="10 simples ejercicios para mantener nuestro cuerpo en forma";
        $noticia->noticia="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        $noticia->description="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut ";
        $noticia->publicate_state=1;
        $noticia->cant_access_read=3;
        $noticia->cant_shares=3;
        $noticia->tema_id=1;
        $noticia->hostal_id=2;
        $noticia->user_id=4;
        $noticia->tags="ejercicios, cabello saludable,cuerpo saludable";
        $noticia->slug=Str::slug($noticia->title, '-');
        $noticia->keywords="ejercicios, cabello saludable,cuerpo saludable";
        $noticia->save();

        $noticia=new Noticia();
        $noticia->title="Deseas cambiar tu vida? Empodera tu rumbo y llega a tu meta";
        $noticia->noticia="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        $noticia->description="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut ";
        $noticia->publicate_state=1;
        $noticia->cant_access_read=70;
        $noticia->cant_shares=68;
        $noticia->cant_likes=50;
        $noticia->tema_id=2;
        $noticia->hostal_id=2;
        $noticia->user_id=3;
        $noticia->tags="empoderamiento,cambio de vida,estrés";
        $noticia->slug=Str::slug($noticia->title, '-');
        $noticia->keywords="empoderamiento,cambio de vida,estrés";
        $noticia->save();

    }
}
