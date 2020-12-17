<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use App\Traits\HostalTrait;
use App\Traits\MessageTrait;
use Illuminate\Support\Facades\Validator;

class ContactoController extends Controller
{
  use HostalTrait; use MessageTrait;

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'email' => ['required', 'string', 'email', 'max:255'],
          'name' => ['required', 'string'],
          'mensage' => ['required'],
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
        $hostalIdQuery=$this->getHostalByName(request('hostal_id'));
        $contact=new Contacto;
        $contact->email=request('email');
        $contact->name=request('name');
        $contact->mensage=request('mensage');
        $contact->hostal_id=$hostalIdQuery[0]->id;
        $contact->save();
        $this->contactSend($contact);
        $this->contactHosterSend($contact,$hostalIdQuery);
        return $contact;
    }


}
