<?php
namespace App\Traits;
use App\Models\AreaPicture;
use App\Traits\AreaPictureTrait;

trait AreaPictureTrait {

  public function getAreaById($id){
  $area=AreaPicture::find($id);
  return  $area;
  }

}
