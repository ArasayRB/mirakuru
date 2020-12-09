<?php

namespace App\Traits;
use App\Models\ReservaToken;

trait ReservaTokenTrait {


    public function storeReservaToken($datos){
      $reserva=new ReservaToken;
      $reserva->user_id=$datos['user_id'];
      $reserva->reserva=$datos['reserva'];
      $reserva->token=$datos['token'];
      $reserva->created_at=$datos['created_at'];
      $reserva->save();

                   return $reserva;
    }

    public function findToken($token){
      $reserva=ReservaToken::where('token',$token)
                            ->get();
                            return $reserva;
    }

    public function deleteTokenReserva(ReservaToken $tokenReserva){
      $reserva=ReservaToken::find($tokenReserva->id);
      $reserva->delete();
    }
}
