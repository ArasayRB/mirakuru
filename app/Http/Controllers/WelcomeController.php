<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PostTrait;
use App\Traits\HostalTrait;
use App\Traits\UserTrait;
use App\Traits\MessageTrait;
use App\Traits\ComentarioHostalTrait;
use App\Traits\ReservaTrait;
use App\Traits\ReservaTokenTrait;
use Carbon\Carbon;

class WelcomeController extends Controller
{
  use PostTrait; use ComentarioHostalTrait; use HostalTrait; use UserTrait; use MessageTrait; use ReservaTrait;use ReservaTokenTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

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
      $posts=$this->existPost();
        return view('home',['posts'=>$posts]);
    }

    public function getPostsList(){
      $posts_more_liked=$this->getPostsMoreLikes(3);
      $posts_more_read=$this->getPostsMoreRead(3);
      $latest_posts=$this->getLatestPosts(3);
      $posts=$this->getPosts();
      return ['posts'=>$posts,'posts_more_liked'=>$posts_more_liked,'posts_more_read'=>$posts_more_read,'latest_posts'=>$latest_posts];
    }

    public function showPost($id){
      return $this->show($id,'real');
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
