<?php
namespace App\Traits;
use App\Models\TemaNoticia;

trait TemaNoticiaTrait {


  public function getTemaById($id){
    $tema=TemaNoticia::find($id);

  return  $tema;
  }

}
