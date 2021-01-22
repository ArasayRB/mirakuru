<?php

namespace App\Http\Controllers;

use App\Models\ComentarioHostal;
use App\Traits\HostalTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class ComentarioHostalController extends Controller
{
  use HostalTrait; use UserTrait;

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
    public function index()
    {
        return view('coments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComentarioHostal  $comentarioHostal
     * @return \Illuminate\Http\Response
     */
    public function show(ComentarioHostal $comentarioHostal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComentarioHostal  $comentarioHostal
     * @return \Illuminate\Http\Response
     */
    public function edit(ComentarioHostal $comentarioHostal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComentarioHostal  $comentarioHostal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComentarioHostal $comentarioHostal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComentarioHostal  $comentarioHostal
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComentarioHostal $comentarioHostal)
    {
        //
    }
}
