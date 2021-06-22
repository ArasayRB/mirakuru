<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Temporada;
use Carbon\Carbon;

class TemporadaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $date_in = Carbon::createFromFormat('Y-m-d', '2020-11-15');
      $date_out = Carbon::createFromFormat('Y-m-d', '2021-05-30');
      $temporada=new Temporada();
      $temporada->name='Alta';
      $temporada->date_in=$date_in;
      $temporada->date_out=$date_out;
      $temporada->save();

      $date_in = Carbon::createFromFormat('Y-m-d', '2021-06-01');
      $date_out = Carbon::createFromFormat('Y-m-d', '2021-07-15');
      $temporada=new Temporada();
      $temporada->name='Baja';
      $temporada->date_in=$date_in;
      $temporada->date_out=$date_out;
      $temporada->save();

      $date_in = Carbon::createFromFormat('Y-m-d', '2021-09-15');
      $date_out = Carbon::createFromFormat('Y-m-d', '2021-11-14');
      $temporada=new Temporada();
      $temporada->name='Baja';
      $temporada->date_in=$date_in;
      $temporada->date_out=$date_out;
      $temporada->save();

      $date_in = Carbon::createFromFormat('Y-m-d', '2021-11-15');
      $date_out = Carbon::createFromFormat('Y-m-d', '2022-05-30');
      $temporada=new Temporada();
      $temporada->name='Alta';
      $temporada->date_in=$date_in;
      $temporada->date_out=$date_out;
      $temporada->save();


    }
}
