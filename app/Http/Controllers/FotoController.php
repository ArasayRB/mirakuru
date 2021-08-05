<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Traits\HostalTrait;
use App\Traits\AreaPictureTrait;
use App\Traits\ImageTrait;
use App\Traits\FotoTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class FotoController extends Controller
{
use HostalTrait, FotoTrait, ImageTrait, AreaPictureTrait;
  public function gallery($hostalSlug){
   $hostal=$this->getHostalBySlug($hostalSlug);
   $hostal->pictures=$this->getPicturesByHostal($hostal[0]->id);
   return view('galeria',['hostal'=>$hostal]);

  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
      $dataPost=request()->validate([
        'image'=> 'required|image',
        'area'=> 'required',
        'hostal'=> 'required',
      ]);
      $hostal=$this->getNameHostalById(request('hostal'));
      $area=$this->getAreaById(request('area'));
      $newFileName=$this->manageImageFile(request('image'),'hostales/'.$hostal['slug'].'/'.$area['name']);
      $foto=new Foto();
      $foto->name=$area['name'];
      $foto->description=$area['name'];
      $foto->slug=Str::slug($newFileName, '-');
      $foto->img_url=$newFileName;
      $foto->hostal_id=request('hostal');
      $foto->area_id=request('area');
      $foto->ppal=0;
      $foto->save();
      $foto->area_name=$area['name'];
      $foto->update_bool='false';
      $foto->deleted_bool='false';
      return $foto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
      $foto=Foto::findOrFail($foto->id);
      $foto->name=request('name');
      $foto->description=request('description');
      $foto->update();
      return $foto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $foto)
    {
        $foto=Foto::find($foto);
        $hostal=$this->getNameHostalById($foto->hostal_id);
        $area=$this->getAreaById($foto->area_id);
        $this->delImageFile($foto->img_url,'hostales/'.$hostal->slug.'/'.$area->name.'/');
        $file_path = public_path("storage/hostales/'.$hostal->slug.'/'.$area->name.'/'.$foto->img_url");
       if(File::exists($file_path)) File::delete($file_path);
        $foto->delete();
         return response()->json('Image deleted');
    }
}
