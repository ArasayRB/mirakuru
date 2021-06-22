<?php

namespace App\Traits;
use App\Models\Reserva;

trait ReservaTrait {


    public function searchFinishedBooks($today,$user){
      $reservas=[];
      if($user==='todos'){
        $reservas=Reserva::where('date_out','<=',$today)
                         ->where('active',1)
                         ->get();
                     }
      else{
       $reservas=Reserva::where('date_out','<=',$today)
                        ->where('active',1)
                        ->where('user_id',auth()->user()->id)
                        ->get();
      }
                       return $reservas;
    }


}
