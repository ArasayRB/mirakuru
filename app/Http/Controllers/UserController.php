<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\RoleTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

  use RoleTrait; use UserTrait;

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
      return view('admin.users.index');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required', 'max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
        ]);
    }

    public function getUsersList(){
      $users=User::with('permissions')
                 ->with('roles')
                 ->orderBy('created_at','asc')
                 ->get();
      for($i=0;$i<count($users);$i++){
        $users[$i]->role_id=$users[$i]->roles[0]->id;
      }
      return $users;
    }

    public function perfil(){
      return view('userPerfil');
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
      $user=new User();
      $user->name=request('name');
      $user->email=request('email');
      $user->password=Hash::make(request('password'));
      $user->save();
      $permissions=explode(',',request('selectedPermissions'));
      $created=Carbon::now()->format('Y-m-d');
      $user->roles()->attach(request('roll'),array('created_at'=>$created,'updated_at'=>$created));
      for($i=0;$i<count($permissions);$i++) {
        $user->permissions()->attach($permissions[$i],array('created_at'=>$created,'updated_at'=>$created));
      }
      return $this->getUserById($user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $dataPost=request()->validate([
        'name'=> 'required|max:255',
        'email'=> 'required'
      ]);
      $permisos=explode(',',request('permissions'));
      $user=User::findOrFail($user->id);
      $user->name=request('name');
      $email=request('email');
      if($email!='undefined'&&$email!=''){

        $user->email=$email;
      }
      $passw=request('password');
      if($passw!=''&&$passw!='undefined'){
        $dataUser=request()->validate([
          'password'=> 'required|between:8,255|confirmed',
          'password_confirm'=> 'required'
        ]);
        $user->password=$passw;
        $user->password_confirm=request('password_confirm');
      }
      $user->update();
      $user->roles()->detach();
      $user->permissions()->detach();
      if(request('role')!='undefined'&&request('role')!=''){
        $user->roles()->attach(request('role'));
      }
      if(is_array($permisos)&&count($permisos)!=0){
        foreach ($permisos as $permiso) {
          $user->permissions()->attach($permiso);
        }
      }
        return $this->getUserById($user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user=User::findOrFail($user->id);
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
    }
}
