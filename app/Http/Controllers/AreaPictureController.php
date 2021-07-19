<?php

namespace App\Http\Controllers;

use App\Models\AreaPicture;
use Illuminate\Http\Request;

class AreaPictureController extends Controller
{

    /**
     * Get a list of Pictures Areas
     */
   public function getAreaPictureList(){
     return AreaPicture::all();

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
