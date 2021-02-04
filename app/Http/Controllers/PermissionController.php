<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'name' => 'required', 'max:255',
          'description' => 'required',
      ]);
  }


  public function getPermissionList(){
    $permissions=Permission::all();
    return $permissions;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.permisos.index');
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
        $permiso=new Permission();
        $permiso->name=request('name');
        $permiso->description=request('description');
        $permiso->slug=Str::slug($permiso->name, '-');
        $permiso->save();
        return $permiso;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {

          $this->validator($request->all())->validate();
          $permiso=Permission::findOrFail($permission->id);
          $permiso->name=request('name');
          $permiso->description=request('description');
          $permiso->slug=Str::slug($permiso->name, '-');
          $permiso->update();
          return $permiso;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permiso=Permission::findOrFail($permission->id);
        $permiso->delete();
    }
}
