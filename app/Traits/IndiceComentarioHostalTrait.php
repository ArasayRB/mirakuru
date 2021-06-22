<?php
namespace App\Traits;
use App\Models\IndiceComentarioHostal;

trait IndiceComentarioHostalTrait {


  public function getIdIndiceByName($name){
    $indice=IndiceComentarioHostal::where('name',$name)
                                         ->get();
  return  $indice[0]->id;
  }

  public function getIndicesComentHostals(){
    $indices=IndiceComentarioHostal::all();
    return $indices;
  }

}
