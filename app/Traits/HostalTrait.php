<?php
namespace App\Traits;
use App\Models\Hostal;

trait HostalTrait {


  public function getHostalByName($name){
    $hostal=Hostal::where('name',$name)
                    ->get();
  return  $hostal;
  }


  public function getHostalServiceActive($nameHostal){
    $serviceHostalActive=Hostal::with('services')
                    ->where('name',$nameHostal)
                    ->get();
  return  $serviceHostalActive;
  }

  public function getHostalIdByName($nameHostal){
    $id=Hostal::where('name',$nameHostal)
                    ->get();
  return  $id[0]->id;
  }
}
