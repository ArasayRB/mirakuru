<?php
namespace App\Traits;
use App\Models\Noticia;
use App\Traits\TemaNoticiaTrait;
use App\Traits\HostalTrait;
use App\Traits\UserTrait;

trait NoticiaTrait {
 use TemaNoticiaTrait;use HostalTrait;use UserTrait;

  public function getLastNewsWelcome(){
    $noticia=[];
    $exist_equal='';
    $noticia_read=$this->readNews();
    $noticia_last=$this->lastNews();
    $noticia_share=$this->shareNews();
    if(count($noticia_last)!=0){
      $tema=$this->getTemaById($noticia_last[0]->tema_id);
      $user=$this->getUserById($noticia_last[0]->user_id);
      $hostal=$this->getNameHostalById($noticia_last[0]->hostal_id);
      $noticia_last[0]->tema_name=$tema->name;
      $noticia_last[0]->hostal_name=$hostal->name;
      $noticia_last[0]->user_name=$user;
      $noticia[]=$noticia_last[0];
    }
    if(count($noticia_read)!=0 && $noticia_read[0]->id!=$noticia_last[0]->id && $noticia_read[0]->id!=$noticia_share[0]->id){
      $tema=$this->getTemaById($noticia_read[0]->tema_id);
      $user=$this->getUserById($noticia_read[0]->user_id);
      $hostal=$this->getNameHostalById($noticia_read[0]->hostal_id);
      $noticia_read[0]->tema_name=$tema->name;
      $noticia_read[0]->hostal_name=$hostal->name;
      $noticia_read[0]->user_name=$user;
      $noticia[]=$noticia_read[0];
    }
    else{
      $exist_equal='1';
      $tema=$this->getTemaById($noticia_read[1]->tema_id);
      $user=$this->getUserById($noticia_read[1]->user_id);
      $hostal=$this->getNameHostalById($noticia_read[1]->hostal_id);
      $noticia_read[1]->tema_name=$tema->name;
      $noticia_read[1]->hostal_name=$hostal->name;
      $noticia_read[1]->user_name=$user;
      $noticia[]=$noticia_read[1];
    }
    if(count($noticia_share)!=0){
      if($noticia_share[0]->id!=$noticia_read[0]->id){
        if($noticia_share[0]->id!=$noticia_last[0]->id){
          if($exist_equal===''){
            $tema=$this->getTemaById($noticia_share[0]->tema_id);
            $user=$this->getUserById($noticia_share[0]->user_id);
            $hostal=$this->getNameHostalById($noticia_share[0]->hostal_id);
            $noticia_share[0]->tema_name=$tema->name;
            $noticia_share[0]->hostal_name=$hostal->name;
            $noticia_share[0]->user_name=$user;
            $noticia[]=$noticia_share[0];
          }
          else if($exist_equal!=''){
            if($noticia_share[0]->id!=$noticia_read[1]->id){
              $tema=$this->getTemaById($noticia_share[0]->tema_id);
              $user=$this->getUserById($noticia_share[0]->user_id);
              $hostal=$this->getNameHostalById($noticia_share[0]->hostal_id);
              $noticia_share[0]->tema_name=$tema->name;
              $noticia_share[0]->hostal_name=$hostal->name;
              $noticia_share[0]->user_name=$user;
              $noticia[]=$noticia_share[0];
            }
            else{
              $tema=$this->getTemaById($noticia_share[1]->tema_id);
              $user=$this->getUserById($noticia_share[1]->user_id);
              $hostal=$this->getNameHostalById($noticia_share[1]->hostal_id);
              $noticia_share[1]->tema_name=$tema->name;
              $noticia_share[1]->hostal_name=$hostal->name;
              $noticia_share[1]->user_name=$user;
              $noticia[]=$noticia_share[1];
            }
          }
        }
        else{
          $tema=$this->getTemaById($noticia_share[1]->tema_id);
          $user=$this->getUserById($noticia_share[1]->user_id);
          $hostal=$this->getNameHostalById($noticia_share[1]->hostal_id);
          $noticia_share[1]->tema_name=$tema->name;
          $noticia_share[1]->hostal_name=$hostal->name;
          $noticia_share[1]->user_name=$user;
          $noticia[]=$noticia_share[1];
        }

      }

    }

  return  $noticia;
  }

 public function readNews(){
   $noticia=Noticia::where('publicate_state',1)
                   ->orderBy('cant_access_read','DESC')
                   ->get();
  return $noticia;
 }

 public function lastNews(){
   $noticia=Noticia::where('publicate_state',1)
                   ->orderBy('created_at', 'DESC')
                   ->get();
  return $noticia;
 }

 public function shareNews(){
   $noticia=Noticia::where('publicate_state',1)
                   ->orderBy('cant_shares','DESC')
                   ->get();
  return $noticia;
 }

}
