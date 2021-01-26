<?php

namespace App\Http\Controllers;

use App\Models\ComentarioHostal;
use App\Traits\HostalTrait;
use App\Traits\UserTrait;
use App\Traits\ComentarioHostalTrait;
use App\Traits\CalificacionCommentHostalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComentarioHostalController extends Controller
{
  use HostalTrait; use UserTrait; use ComentarioHostalTrait; use CalificacionCommentHostalTrait;


  public function __construct()
  {
      $this->middleware('auth');
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'review_value' => ['required', 'string'],
          'hoster_atention_value' => ['required', 'integer'],
          'services_value' => ['required', 'integer'],
          'confort_value' => ['required', 'integer'],
          'location_value' => ['required', 'integer'],
          'clean_value' => ['required', 'integer'],
      ]);
  }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validator($request->all())->validate();
      $hostalIdQuery=$this->getHostalByName(request('hostal_name'));
      $clean=request('clean_value');
      $service=request('services_value');
      $hoster=request('hoster_atention_value');
      $location=request('location_value');
      $confort=request('confort_value');
      $valuation;
      $aprox=($clean+$service+$hoster+$location+$confort)/5;
      if($aprox<=1){
        $valuation=1;
      }
      else if(1<$aprox && $aprox<=2.5){
        $valuation=2;
      }
      else if(2.5<$aprox && $aprox<=3.5){
        $valuation=3;
      }
      else if(3.5<$aprox && $aprox<=4.5){
        $valuation=4;
      }
      else if(4.5<$aprox && $aprox<=5){
        $valuation=5;
      }
      $calif_id=$this->getCalificationHostalByCalification($valuation);
      $comentario=new ComentarioHostal;
      $comentario->user_id=auth()->user()->id;
      $comentario->comment=request('review_value');
      $comentario->calification_id=$calif_id;
      $comentario->hostal_id=$hostalIdQuery[0]->id;
      $comentario->save();
      return $comentario;
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
