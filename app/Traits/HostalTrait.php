<?php
namespace App\Traits;
use App\Models\Hostal;

trait HostalTrait {


  public function getHostalByName($name){
    $hostal=Hostal::where('name','Hostal Mirakuru Gran Familia')
                    ->get();
  return  $hostal;
  }

}
