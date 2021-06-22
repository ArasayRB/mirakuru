<?php

namespace App\Http\Controllers;

use App\Models\ComentarioHostal;
use App\Traits\HostalTrait;
use App\Traits\UserTrait;
use App\Traits\IndiceComentarioHostalTrait;
use App\Traits\ComentarioHostalTrait;
use App\Traits\CalificacionCommentHostalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComentarioHostalController extends Controller
{
  use HostalTrait; use UserTrait; use ComentarioHostalTrait; use CalificacionCommentHostalTrait; use IndiceComentarioHostalTrait;


  public function __construct()
  {
      $this->middleware('auth');
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'review_value' => ['required', 'string'],
          'indices' => ['required'],
          'indices_value' => ['required'],
          'hostal_name' => ['required', 'string'],
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
      $newIndicesValue=explode(',',request('indices_value'));
      $newIndices=explode(',',request('indices'));
      if(count($newIndices)!=count($newIndicesValue)){
        return 'You cannot leave empty fields, please check';
      }
      $this->validator($request->all())->validate();
      $hostalIdQuery=$this->getHostalByName(request('hostal_name'));
      $indices_request=$newIndices;
      $indices_value_requ=$newIndicesValue;


      $comentario=new ComentarioHostal;
      $comentario->user_id=auth()->user()->id;
      $comentario->comment=request('review_value');
      $comentario->hostal_id=$hostalIdQuery[0]->id;
      $comentario->save();
      for($i=0;$i<count($indices_request);$i++){
        $calif_id=$this->getCalificationHostalByCalification($indices_value_requ[$i]);

        $comentario->indicesComentario()->attach($indices_request[$i], array('calificacion_id'=>$calif_id));
      }

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
