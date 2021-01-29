<?php

namespace App\Traits;
use App\Models\ComentarioHostal;
use App\Traits\CalificacionCommentHostalTrait;

trait ComentarioHostalTrait {

use CalificacionCommentHostalTrait;
    public function searchComentByUserAndDate($user,$date,$hostal_id){
      $coments=ComentarioHostal::where('user_id',$user)
                       ->where('created_at','>=',$date)
                       ->where('hostal_id',$hostal_id)
                       ->exists();
                       return $coments;
    }

    public function verifyTestimonial($hostal_name,$cant){

      $find_id_hostal=$this->getHostalIdByName($hostal_name);
      $find_coment;
      $value;
      $cant;
      if($cant!=0){
      $find_coment=ComentarioHostal::with('indicesComentario')
                                   ->where('hostal_id',$find_id_hostal)
                                   ->take($cant)
                                   ->get();
                                   }
      else{
        $find_coment=ComentarioHostal::with('indicesComentario')
                                     ->where('hostal_id',$find_id_hostal)
                                     ->get();
      }
      for($i=0;$i<count($find_coment);$i++){
        $sum=0;
        $prom=0;
        for($n=0;$n<count($find_coment[$i]->indicesComentario);$n++) {
          $valor=$this->getCalificationHostalById($find_coment[$i]->indicesComentario[$n]->pivot->calificacion_id);
          $sum+=$valor->calification;
          $prom++;
        }

        $calific=$sum/$prom;
        if($calific<=1){
          $value=1;
        }
        else if(1<$calific && $calific<=2.5){
          $value=2;
        }
        else if(2.5<$calific && $calific<=3.5){
          $value=3;
        }
        else if(3.5<$calific && $calific<=4.5){
          $value=4;
        }
        else if(4.5<$calific && $calific<=5){
          $value=5;
        }
        
        $user=$this->getUserById($find_coment[$i]->user_id);
        $find_coment[$i]->user=$user;
        $find_coment[$i]->calification_id=$value;
      }
                                   return $find_coment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexComentarioHostalPpal()
    {
        return view('testimonials.index');
    }


}
