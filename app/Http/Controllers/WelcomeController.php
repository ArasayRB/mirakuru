<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PostTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use App\Traits\HostalTrait;
use App\Traits\UserTrait;
use App\Traits\FotoTrait;
use App\Traits\NoticiaTrait;
use App\Traits\MessageTrait;
use App\Traits\ComentarioHostalTrait;
use App\Traits\IndiceComentarioHostalTrait;
use App\Traits\ReservaTrait;
use App\Traits\ReservaTokenTrait;
use Carbon\Carbon;

class WelcomeController extends Controller
{
  use PostTrait;use FotoTrait; use ComentarioHostalTrait;use NoticiaTrait; use HostalTrait;use IndiceComentarioHostalTrait; use UserTrait; use MessageTrait; use ReservaTrait;use ReservaTokenTrait; use TranslateTrait; use LanguageTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getIndicesComentHostal(){
      return $this->getIndicesComentHostals();
    }

    public function verifyTestimonialComent($hostal_name,$cant){
      return $this->verifyTestimonial($hostal_name,$cant);
    }

    public function indexComentarioHostal(){
      return $this->indexComentarioHostalPpal();
    }

    public function sendEmailForReview(){

        $today=Carbon::now()->format('Y-m-d');
        $diffday_two=Carbon::now();
        $activeDate=$diffday_two->toDateString();
        $user='todos';
        $reservas=$this->searchFinishedBooks($today,$user);
        $no_coments_books=[];
        $datosTokenReserva=[];
        foreach ($reservas as $reserva) {
          $bookUncoment=$this->searchComentByUserAndDate($reserva->user_id,$reserva->date_out,$reserva->hostal_id);
          if(!$bookUncoment){
            $diffday_one=Carbon::create($reserva->date_out);
            $days_to_send=$diffday_one->diffInDays($diffday_two);
            if($days_to_send===15 || $days_to_send===30){
            $hostal_name=$this->getNameHostalById($reserva->hostal_id);
            $user_mail=$this->getUserById($reserva->user_id);
            $reserva->hostal_name=$hostal_name->name;
            $reserva->user_mail=$user_mail;
            $token=csrf_token();
            $no_coments_books[]=$reserva;
            $dato_reserva=['email'=>$user_mail->email,
                                'reserva'=>$reserva->id,
                                'user_id'=>$reserva->user_id,
                                'date_in'=>$reserva->date_in,
                                'date_out'=>$reserva->date_out,
                                'hostal'=>$hostal_name->name,
                                'token'=>$token,
                                'created_at'=>$activeDate,
                                'name'=>$reserva->name];
                                $this->reviewAdviceSend($dato_reserva);
            $datosReserva[]=$dato_reserva;
          }
          }
        }
        return $no_coments_books;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function welcome()
    {
        return view('welcome_search');
    }

    public function hostalLink($slug){
        $posts=$this->existPost();
        $hostal=$this->getHostalBySlug($slug);
        $hostal->pictures=$this->getPicturesByHostal($hostal[0]->id);
        return view('welcome',['posts'=>$posts,'hostal'=>$hostal]);
    }

    public function getPostsList(){
      $posts_more_liked=$this->getPostsMoreLikes(3);
      for ($i=0;$i<count($posts_more_liked);$i++) {
        if($posts_more_liked[$i]->default_lang!=app()->getLocale()){
        $post_liked=$this->getTranslatedPostBySigLang(app()->getLocale(),$posts_more_liked[$i]->id);
        $posts_more_liked[$i]->title=$post_liked->title;
        $posts_more_liked[$i]->content=$post_liked->content;
        $posts_more_liked[$i]->summary=$post_liked->summary;

      }
      }
      $posts_more_read=$this->getPostsMoreRead(3);
      for ($i=0;$i<count($posts_more_read);$i++) {
        if($posts_more_read[$i]->default_lang!=app()->getLocale()){
          $post_read=$this->getTranslatedPostBySigLang(app()->getLocale(),$posts_more_read[$i]->id);
        $posts_more_read[$i]->title=$post_read->title;
        $posts_more_read[$i]->content=$post_read->content;
        $posts_more_read[$i]->summary= $post_read->summary;
      }
      }
      $latest_posts=$this->getLatestPosts(3);
      for ($i=0;$i<count($latest_posts);$i++) {
        if($latest_posts[$i]->default_lang!=app()->getLocale()){
          $latest=$this->getTranslatedPostBySigLang(app()->getLocale(),$latest_posts[$i]->id);
        $latest_posts[$i]->title=$latest->title;
        $latest_posts[$i]->content=$latest->content;
        $latest_posts[$i]->summary=$latest->summary;
      }
      }
      $posts=$this->getPosts();
      for ($i=0;$i<count($posts);$i++) {
        if($posts[$i]->default_lang!=app()->getLocale()){
          $post=$this->getTranslatedPostBySigLang(app()->getLocale(),$posts[$i]->id);
        $posts[$i]->title=$post->title;
        $posts[$i]->content=$post->content;
        $posts[$i]->summary=$post->summary;
       }
      }
      return ['posts'=>$posts,'posts_more_liked'=>$posts_more_liked,'posts_more_read'=>$posts_more_read,'latest_posts'=>$latest_posts];
    }

    public function showPost($slug){
      return $this->show($slug,'real');
    }

    public function relationedPost($id){
      return $this->relationedPostByTags($id);
    }

    public function addLove($id){
      return $this->addLovePost($id);
    }

    public function sharePostMedia($id,$media){
      return $this->sharePostMediaSocial($id,$media);
    }

    public function anyExistingPost(){
    $answare= $this->existPost();
    return $answare;
    }
}
