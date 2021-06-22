<?php

namespace Database\Seeders;

use App\Models\ClosePlace;
use Illuminate\Database\Seeder;

class ClosePlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $place=new ClosePlace();
        $place->name='Parque Céspedes';
        $place->description_place='Parque Central de Trinidad';
        $place->save();
        $place->hostales()->attach(1,['distance_km'=>'0,1','distance_walking'=>'3min']);

        $place=new ClosePlace();
        $place->name='Casa de la Música';
        $place->description_place='Lugar recreativo y bailable de la ciudad';
        $place->save();
        $place->hostales()->attach(1,['distance_km'=>'0,4','distance_walking'=>'10min']);

        $place=new ClosePlace();
        $place->name='Playa Ancón';
        $place->description_place='Plya de la ciudad más visitada';
        $place->save();
        $place->hostales()->attach(1,['distance_km'=>'16','distance_walking'=>'1:30 hr']);
    }
}
