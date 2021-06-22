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

    public function findToken($token,$reserva,$user){
      $reserva=ReservaToken::where('token',$token)
                             ->where('reserva',$reserva)
                             ->where('user_id',$user)
                             ->get();
                            return $reserva;
    }

    public function deleteTokenReserva(ReservaToken $tokenReserva){
      $reserva=ReservaToken::find($tokenReserva->id);
      $reserva->delete();
    }
}
