<?php

namespace App\Http\Controllers;

use App\Traits\HostalTrait;
use App\Traits\HabitacionTrait;
use App\Traits\ReservaTokenTrait;
use App\Traits\MessageTrait;
use App\Models\Reserva;
use App\Traits\CountryTrait;
use App\Traits\ServicioTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ReservaController extends Controller
{
  use HostalTrait; use HabitacionTrait; use CountryTrait; use ServicioTrait; use ReservaTokenTrait;
  use MessageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'name' => ['required', 'string'],
            'adress' => ['required', 'string', 'max:255'],
            'pais' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'rooms' => ['required', 'string'],
            'cant_person' => ['required', 'integer'],
            'childs' => ['required', 'integer'],
            'date_in' => ['required', 'date'],
            'date_out' => ['required', 'date'],
        ]);
    }

    public function getHostalServices($hostal){
      return $this->getHostalServiceActive($hostal);
    }

    public function getHostalRooms($hostal){
      $idHostal=$this->getHostalIdByName($hostal);
      return $this->getHostalRoomsActive($idHostal);

    }

    public function getCountries(){
      return $this->getAllCountries();
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
        $this->validator($request->all())->validate();
        $servicios = explode(",", request('service'));
        $rooms = explode(",", request('rooms'));
        $hostalIdQuery=$this->getHostalByName(request('hostal_id'));
        $reserva=new Reserva;
        $reserva->active=false;
        $reserva->name=request('name');
        $reserva->adress=request('adress');
        $reserva->country_id=request('pais');
        $reserva->phone=request('phone');
        $reserva->rooms=request('rooms');
        $reserva->service=request('service');
        $reserva->totally_persons=request('cant_person');
        $reserva->child=request('childs');
        $reserva->amount=request('amount');
        $reserva->date_in=request('date_in');
        $reserva->date_out=request('date_out');
        $reserva->user_id=auth()->user()->id;
        $reserva->hostal_id=$hostalIdQuery[0]->id;
        $reserva->save();
          $actual_date=Carbon::now();
          $activeDate=$actual_date->toDateString();
        for($i=0;$i<count($rooms);$i++){
          $habiId=$this->getHabByName($rooms[$i]);
          $reserva->habitaciones()->attach($habiId[0]->id, array('active'=>false));
        }

        for($i=0;$i<count($servicios);$i++){
          $serviId=$this->findServicio($servicios[$i]);
          $reserva->servicios()->attach($serviId, array('active'=>false,'persons'=>request('cant_person')));
        }
        $datosTokenReserva=['email'=>request('email'),
                            'reserva'=>$reserva->id,
                            'user_id'=>$reserva->user_id,
                            'token'=>request('token'),
                            'created_at'=>$activeDate,
                            'name'=>$reserva->name];
        $this->storeReservaToken($datosTokenReserva);
        $this->confirmReservationSend($datosTokenReserva);


    }

    public function confirmReservation($token,$reserva,$user){
      $reserva=Reserva::with('servicios')->with('habitaciones')->find($reserva);
      $reserva->active=true;
      $reserva->update();
      $tokenReserva=$this->findToken($token);
      if($tokenReserva){
        $actual_date=Carbon::now();
        $activeDate=$actual_date->toDateString();
        foreach($reserva->servicios as $servicio){
          $reserva->servicios()->updateExistingPivot($servicio->id,array('active'=>true,'active_date'=>$activeDate));
        }
        foreach($reserva->habitaciones as $habitacion){
          $reserva->habitaciones()->updateExistingPivot($habitacion->id,array('active'=>true,'active_date'=>$activeDate));
        }
        $this->deleteTokenReserva($tokenReserva[0]);
      }
      return view('home',['message'=>''.Lang::get('Reservation Confirmed succefully. Thank you!')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
