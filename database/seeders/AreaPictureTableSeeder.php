<?php

namespace Database\Seeders;

use App\Models\AreaPicture;
use Illuminate\Database\Seeder;

class AreaPictureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area=new AreaPicture();
        $area->name='Sala';
        $area->save();

        $area=new AreaPicture();
        $area->name='Saleta';
        $area->save();

        $area=new AreaPicture();
        $area->name='Habitaciones';
        $area->save();

        $area=new AreaPicture();
        $area->name='Area_de_Servicio';
        $area->save();

        $area=new AreaPicture();
        $area->name='Terraza';
        $area->save();

        $area=new AreaPicture();
        $area->name='Frente';
        $area->save();

        $area=new AreaPicture();
        $area->name='Otras_Areas';
        $area->save();

    }
}
