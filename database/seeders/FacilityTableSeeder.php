<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facility=new Facility();
        $facility->name='Aire Acondicionado';
        $facility->description='Refresca el ambiente hasta temperaturas bajas';
        $facility->save();
        $facility->hostals()->attach(1,['price'=>0.00]);

        $facility=new Facility();
        $facility->name='Ventilador';
        $facility->description='Refresca el ambiente con el aire natural de la habitación';
        $facility->save();
        $facility->hostals()->attach(1,['price'=>0.00]);

        $facility=new Facility();
        $facility->name='Secador de Pelo';
        $facility->description='Para uso en el cabello luego del lavado';
        $facility->save();
        $facility->hostals()->attach(1,['price'=>0.00]);

        $facility=new Facility();
        $facility->name='Lámpara de Noche';
        $facility->description='Para iluminar a media luz su habitación durante la noches';
        $facility->save();
        $facility->hostals()->attach(1,['price'=>0.00]);

        $facility=new Facility();
        $facility->name='Agua Caliente/Fría';
        $facility->description='Presente en ducha y/o lavamanos del baño para comodidad del cliente';
        $facility->save();
        $facility->hostals()->attach(1,['price'=>0.00]);

        $facility=new Facility();
        $facility->name='Mini Bar';
        $facility->description='Mini Refrigerador con productos de posible consumo por el cliente, los cuales sí llevan un precio por unidad y consumo';
        $facility->save();
        $facility->hostals()->attach(1,['price'=>0.00]);

        $facility=new Facility();
        $facility->name='Caja Fuerte';
        $facility->description='Caja de seguridad para preservar sus efectos personales de valor';
        $facility->save();
        $facility->hostals()->attach(1,['price'=>0.00]);
    }
}
