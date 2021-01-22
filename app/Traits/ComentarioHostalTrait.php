<?php

namespace App\Traits;
use App\Models\ComentarioHostal;

trait ComentarioHostalTrait {


    public function searchComentByUserAndDate($user,$date,$hostal_id){
      $coments=ComentarioHostal::where('user_id',$user)
                       ->where('created_at','>=',$date)
                       ->where('hostal_id',$hostal_id)
                       ->exists();
                       return $coments;
    }


}
