<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PostTrait;

class WelcomeController extends Controller
{
  use PostTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function welcome()
    {
      $posts=$this->getPosts();
        return view('welcome',['posts'=>$posts]);
    }

    public function showPost($id){
      return $this->show($id);
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
