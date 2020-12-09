<?php

namespace App\Traits;
use App\Models\Servicio;

trait ServicioTrait {


    public function findServicio($servicio){
      $servicios = Servicio::where('name',$servicio)
                       ->get();

                   return $servicios[0]->id;
    }
}
