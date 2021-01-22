<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PostTrait;
use App\Traits\ComentarioHostalTrait;
use App\Traits\ReservaTrait;
use Carbon\Carbon;

class HomeController extends Controller
{
  use PostTrait; use ReservaTrait; use ComentarioHostalTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $posts=$this->existPost();
        return view('home',['posts'=>$posts]);
    }

    public function showMsgMakeComent(){
      $today=Carbon::now()->format('Y-m-d');
      $reservas=$this->searchFinishedBooks($today);
      $no_coments_books=[];
      foreach ($reservas as $reserva) {
        $bookUncoment=$this->searchComentByUserAndDate($reserva->user_id,$reserva->date_out,$reserva->hostal_id);
        if(!$bookUncoment){
          $no_coments_books[]=$reserva;
        }
      }
      return $no_coments_books;
    }
}
