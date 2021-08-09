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

  /**
   * Suscriptions List
   */

   public function getSuscriptionsList(){
     $suscriptions=Suscripcion::with('hostales')->get();
     return $suscriptions;
   }

  /**
  *Searcher that display filter service by name
  *@param \Illuminate\Http\Request  $request
  *@return \Illuminate\Http\Request  $request
  */

  public function getAllSuscriptions(Request $request){
    $filter=$request->searcher;
    $suscriptions=Suscripcion::filterByAttribute($filter)
                    ->get();
    $suscriptions_searched=[];
    foreach($suscriptions as $suscription){
      $findText=stristr($suscription->email,$filter);
      if(!empty($findText)){
        $prop='email';
        $suscription->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $suscription->substr=$small_word;
        $suscription->name=$suscription->email;
        $suscription->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$suscription->email);
        $suscriptions_searched[]=$suscription;
      }
    }
    return $suscriptions_searched;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('admin.suscriptions.index');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
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

    /**
     * Delete an item by
     *@param int $suscriptor
     *@param int $hostal
     *@return \Illuminate\Http\Response
     */

    public function delete($suscriptor,$hostal){
      $emailSus=Suscripcion::find($suscriptor);
      $emailSus->hostales()->detach($hostal);
      if(count($emailSus->hostales)==0){
        $emailSus->delete();
      }
      return $emailSus;
    }

    public function unsuscribe($suscriptor,$hostal){
      $emailSus=$this->delete($suscriptor,$hostal);
      return view('welcome',['message'=>''.$emailSus->email.': '.Lang::get('Unsubscribe Successfully')]);
    }
}
