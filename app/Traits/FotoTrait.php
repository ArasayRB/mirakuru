<?php
namespace App\Traits;
use App\Models\Foto;
use App\Traits\AreaPictureTrait;

trait FotoTrait {
 use AreaPictureTrait;

/**
 * Obtain Pictures By Hostal
 *
 *@param int $hostal
 *@return object $pictures
 */
  public function getPicturesByHostal($hostal){
  $pictures=Foto::where('hostal_id',$hostal)
                ->get();
  for ($i=0; $i < count($pictures); $i++) {
    $area=$this->getAreaById($pictures[$i]->area_id);
    $pictures[$i]->area_picture=$area->name;
  }
  return  $pictures;
  }

/**
 * Obtain Pictures By Area and Hostal
 *@param int $area,
 *@param int $hostal
 *@return object $pictures
 */
  public function picturesByAreaHostal(int $area,int $hostal){
    $pictures=Foto::where('area_id',$area)
                  ->where('hostal_id',$hostal)
                  ->get();
                  return $pictures;
  }
}
