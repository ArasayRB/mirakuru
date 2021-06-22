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
  public function __construct()
  {
      $this->middleware('auth');
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

    public function activeBooks(Request $request){

                       return view('reservas');

    }

    public function activeBooksStore($id){
      $reservas=Reserva::with('servicios')
                       ->with('habitaciones')
                       ->where('user_id',$id)
                       ->where('active',true)
                       ->get();
                       return $reservas;
    }

    public function deleteBookByUser(int $book_id, string $email, string $name){
      $reserva=Reserva::findOrFail($book_id);
      $date_inactive=Carbon::now()->format('Y-m-d');

      $reserva->active=false;
      $reserva->updated_at=$date_inactive;
      $reserva->update();
      $reservas=$this->activeBooksStore($reserva->user_id);
      $datosTokenReserva=['email'=>$email,
                          'name'=>$name];
      $this->discardReservationDelete($datosTokenReserva);
      return ['data'=>['reservas'=>$reservas,'message'=>''.Lang::get('You have just deleted a reservation, a notification must be send to your email.')]];
    }

    public function listBooksByUser(Request $request){
      $reservas=$this->activeBooksStore(request('user_id'));
                       return $reservas;
    }

    public function getBlockedDates($hostal){
      $hostalId=$this->getHostalByName($hostal);
      $hostalRooms=$this->getHostalRoomsActive($hostalId[0]->id);
      $blockedRooms=Reserva::select('rooms','date_in','date_out')->where('active',true)->get();
      $blockedDates=array();
      $cantHostalRooms=count($hostalRooms);

      foreach($blockedRooms as $blockedRoom){
    $roomsTotal=explode(',',$blockedRoom->rooms);
      $newArray=$this->newBlockedArray($blockedRoom);
      $blockedDates['together'][]=$newArray;
    if(count($roomsTotal)==$cantHostalRooms){
    $blockedDates['all'][]=$newArray;

    }
    else{
          for($i=0;$i<$cantHostalRooms;$i++){
        //return count($roomsTotal);
         if(count($roomsTotal)>1){
           if($cantHostalRooms!=count($roomsTotal)){
        foreach($roomsTotal as $roomTotal){
        if($hostalRooms[$i]->name===$roomTotal){
        $blockedDates[''.$hostalRooms[$i]->name.''][]=$newArray;

        }
      }
    }

        }
        else if(count($roomsTotal)===1){
          if($hostalRooms[$i]->name===$blockedRoom->rooms){
          $blockedDates[''.$hostalRooms[$i]->name.''][]=$newArray;

          }

        }
      }
    }
      }

      return $blockedDates;
    }

    public function newBlockedArray($blockedRoom){
      $new_array=[];


      $dateIn=Carbon::createFromDate($blockedRoom->date_in);
      $dateOut=Carbon::createFromDate($blockedRoom->date_out);
      $monthIn;
      $dayIn=$dateIn->day;
      $yearIn=$dateOut->year;
      if($dateIn->month==01){
        $monthIn=0;
      }
      else{
        $monthIn=$dateIn->month-1;
      }
      $dayOut=$dateOut->day;
      $yearOut=$dateOut->year;
      $monthOut;
      if($dateOut->month==01){
        $monthOut=0;
      }
      else{
        $monthOut=$dateOut->month-1;
      }
      //$blockedDates[$cont]['rooms']=$blockedRoom->rooms;
      $new_array['day_in']=$dayIn;
      $new_array['year_in']=$yearIn;
      $new_array['month_in']=$monthIn;
      $new_array['day_out']=$dayOut;
      $new_array['year_out']=$yearOut;
      $new_array['month_out']=$monthOut;
      $new_array['start']=$dateIn;
      $new_array['end']=$dateOut;
      return $new_array;
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
        $hostalIdQuery=$this->getHostalByName(request('hostal_id'));
        $cant_habitaciones_hostal=$this->getHostalRoomsActive($hostalIdQuery[0]->id);
        $rooms = explode(",", request('rooms'));

        $date_entrada=explode('-',request('date_in'));
        $date_salida=explode('-',request('date_out'));
        $newDateIn=Carbon::createFromDate($date_entrada[0],$date_entrada[1],$date_entrada[2]);
        $newDateOut=Carbon::createFromDate($date_salida[0],$date_salida[1],$date_salida[2]);
        $days_reserva=$newDateIn->diffInDays($newDateOut);
        $msg=array('msg'=>'You can not book because that dates has been booked by someone else. Sorry, try another dates');
        $booksExistentes=Reserva::where('active',true)
                                 ->get();
                                 $estamos=[];
                                   for($r=0;$r<count($booksExistentes);$r++){
                                   $rooms_bd=explode(',',$booksExistentes[$r]['rooms']);
                                   $n=0;
                                   $date_comp_in='';
                                   foreach($rooms as $room){

                                   while($n<$days_reserva){
                                     $day=$date_entrada[2]+$n;
                                     $whileDate=Carbon::createFromDate($date_entrada[0],$date_entrada[1],$day);

                                     $esta=$whileDate->betweenIncluded($booksExistentes[$r]['date_in'],$booksExistentes[$r]['date_out']);
                                     if($esta===true){
                                       if(in_array($room,$rooms_bd)){

                                           return $msg;
                                         }
                                     }
$n++;

                                                        }
                                                        }
                                                      }





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
        $service=request('service');
        if($service==!''){
        $servicios = explode(",", request('service'));
        for($i=0;$i<count($servicios);$i++){
          $serviId=$this->findServicio($servicios[$i]);
          $reserva->servicios()->attach($serviId, array('active'=>false,'persons'=>request('cant_person')));
        }
      }
        $datosTokenReserva=['email'=>request('email'),
                            'reserva'=>$reserva->id,
                            'user_id'=>$reserva->user_id,
                            'token'=>request('token'),
                            'created_at'=>$activeDate,
                            'name'=>$reserva->name];
        $this->storeReservaToken($datosTokenReserva);
        $this->confirmReservationSend($datosTokenReserva);
        return $reserva;

    }

    public function confirmReservation($token,$reserva,$user){
      $reserva=Reserva::with('servicios')->with('habitaciones')->find($reserva);
      $reserva->active=true;
      $reserva->update();
      $tokenReserva=$this->findToken($token,$reserva->id,$user);
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
        return view('home',['message'=>''.Lang::get('Reservation Confirmed succefully. Thank you!')]);
      }
      else{
        return view('home',['message'=>''.Lang::get('Comunicate with our team by contact message way because we have a problem with your confirmation.')]);
      }


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
