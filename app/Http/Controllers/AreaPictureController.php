<?php

namespace App\Http\Controllers;

use App\Models\AreaPicture;
use App\Traits\ImageTrait;
use App\Traits\HostalTrait;
use App\Traits\FotoTrait;
use Illuminate\Http\Request;

class AreaPictureController extends Controller
{
  use ImageTrait, HostalTrait, FotoTrait;

    /**
     * Get a list of Pictures Areas
     */
   public function getAreaPictureList($id_hostal){
     $areas=AreaPicture::all();
     $hostal=$this->getNameHostalById($id_hostal);
     for($i=0;$i<count($areas);$i++){
       $pictures=$this->picturesByAreaHostal($areas[$i]['id'],$id_hostal);
       for ($y=0; $y < count($pictures); $y++) {
         $pictures[$y]['update_bool']='false';
       }
       $areas[$i]['pictures']=$this->picturesByAreaHostal($areas[$i]['id'],$id_hostal);
       $areas[$i]['pictures_count']=count($areas[$i]['pictures']);
       $areas[$i]['hostal_name']=$hostal['slug'];
     }
     return $areas;

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
     * @param  \App\Models\AreaPicture  $areaPicture
     * @return \Illuminate\Http\Response
     */
    public function show(AreaPicture $areaPicture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AreaPicture  $areaPicture
     * @return \Illuminate\Http\Response
     */
    public function edit(AreaPicture $areaPicture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AreaPicture  $areaPicture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AreaPicture $areaPicture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AreaPicture  $areaPicture
     * @return \Illuminate\Http\Response
     */
    public function destroy(AreaPicture $areaPicture)
    {
        //
    }
}
