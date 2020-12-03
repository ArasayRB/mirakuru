<?php
namespace App\Traits;
use App\Models\Habitacion;

trait HabitacionTrait {


  public function getHostalRoomsActive($idHostal){
    $roomsHostalActive=Habitacion::where('hostal_id',$idHostal)
                    ->get();
  return  $roomsHostalActive;
  }
}
