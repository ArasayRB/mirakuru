<?php

namespace App\Http\Controllers;

use App\Models\Suscripcion;
use App\Traits\HostalTrait;
use App\Traits\MessageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class SuscripcionController extends Controller
{
  use MessageTrait;  use HostalTrait;
    public function store(Request $request){
      $data=request()->validate([
        'email'=> 'required|email',
      ]);
      $suscripcion= new Suscripcion();
      $suscripcion->email=request('email');
      $suscripcion->save();


      $hostal=$this->getHostalByName('HostalMirakuru Gran Familia');
      $suscripcion->hostales()->attach($hostal[0]->id);
      $this->newsletterSend($suscripcion,$hostal[0]->id);
      return $suscripcion;

    }

    public function delete($suscriptor,$hostal){
      $emailSus=Suscripcion::find($suscriptor);

      $emailSus->hostales()->detach($hostal);
      return view('welcome',['message'=>''.$emailSus->email.': '.Lang::get('Unsubscribe Successfully')]);
    }
}
