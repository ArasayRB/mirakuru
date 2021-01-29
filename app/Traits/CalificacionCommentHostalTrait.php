<?php
namespace App\Traits;
use App\Models\CalificacionCommentHostal;

trait CalificacionCommentHostalTrait {


  public function getCalificationHostalByCalification($cal){
    $calification=CalificacionCommentHostal::where('calification',$cal)
                                         ->get();
  return  $calification[0]->id;
  }

  public function getCalificationHostalById($cal){
    $calification=CalificacionCommentHostal::find($cal);
  return  $calification;
  }

}
