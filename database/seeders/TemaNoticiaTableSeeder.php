<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TemaNoticia;

class TemaNoticiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tema=new TemaNoticia();
        $tema->name='Salud y Belleza';
        $tema->save();

        $tema=new TemaNoticia();
        $tema->name='Emprendimiento';
        $tema->save();

        $tema=new TemaNoticia();
        $tema->name='Empoderamiento';
        $tema->save();

        $tema=new TemaNoticia();
        $tema->name='Turismo';
        $tema->save();
    }
}
