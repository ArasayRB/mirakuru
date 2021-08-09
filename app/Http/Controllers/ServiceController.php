<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
  *Searcher that display filter service by name
  *@param \Illuminate\Http\Request  $request
  *@return \Illuminate\Http\Request  $request
  */

  public function getAllServices(Request $request){
    $filter=$request->searcher;
    $services=Servicio::filterByAttribute($filter)
                    ->get();
    $services_searched=[];
    foreach($services as $service){
      $findText=stristr($service->name,$filter);
      if(!empty($findText)){
        $prop='name';
        $service->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $service->substr=$small_word;
        $service->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$service->name);
        $services_searched[]=$service;
      }
    }
    return $services_searched;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.services.index');
    }

   /**
    * Services List
    */

    public function getServiceList(){
      $services=Servicio::all();
      return $services;
    }

    /**
     * Validator Service
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'name_contact' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price_high' => ['required'],
            'price_low' => ['required'],
            'person_max' => ['required'],
            'person_min' => ['required'],
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
      $service=new Servicio();
      $service->name=request('name');
      $service->name_contact=request('name_contact');
      $service->description=request('description');
      $service->price_high=request('price_high');
      $service->price_low=request('price_low');
      $service->person_max=request('person_max');
      $service->person_min=request('person_min');
      $service->save();
      return $service;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $servicio)
    {
        $service=Servicio::findOrFail($servicio);
        $service->name=request('name');
        $service->name_contact=request('name_contact');
        $service->description=request('description');
        $service->price_high=request('price_high');
        $service->price_low=request('price_low');
        $service->person_max=request('person_max');
        $service->person_min=request('person_min');
        $service->update();
        return $service;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $servicio)
    {
        $service=Servicio::findOrFail($servicio);
        $service->delete();
    }
}
