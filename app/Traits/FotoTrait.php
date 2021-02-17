<?php
namespace App\Traits;
use App\Models\Foto;
use App\Traits\AreaPictureTrait;

trait FotoTrait {
 use AreaPictureTrait;

  public function getPicturesByHostal($hostal){
  $pictures=Foto::where('hostal_id',$hostal)
                ->get();
  for ($i=0; $i < count($pictures); $i++) {
    $area=$this->getAreaById($pictures[$i]->area_id);
    $pictures[$i]->area_picture=$area->name;
  }
  return  $pictures;
  }
}
