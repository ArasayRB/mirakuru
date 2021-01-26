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

    public function verifyTestimonial($hostal_name,$cant){

      $find_id_hostal=$this->getHostalIdByName($hostal_name);
      $find_coment;
      if($cant!=0){
      $find_coment=ComentarioHostal::where('hostal_id',$find_id_hostal)
                                   ->take($cant)
                                   ->get();
                                   }
      else{
        $find_coment=ComentarioHostal::where('hostal_id',$find_id_hostal)
                                     ->get();
      }
      for($i=0;$i<count($find_coment);$i++){
        $user=$this->getUserById($find_coment[$i]->user_id);
        $find_coment[$i]->user=$user;
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
