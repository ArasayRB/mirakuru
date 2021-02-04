<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];
    
    public function users(){
      return $this->belongsToMany(User::class,'role_user','role_id','user_id')->withTimestamps();
    }
    public function permissions(){
      return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id')->withTimestamps();
    }

    public function authorizePermisos($permisos){
      abort_unless($this->hasAnyPermiso($permisos), 401);
      return true;
    }

    public function hasAnyPermiso($permisos){
      if(is_array($permisos)){
        foreach ($permisos as $permiso){
          if($this->hasPermiso($permiso)){
            return true;
          }
        }
      }
      else{
        if($this->hasPermiso($permisos)){
          return true;
        }
      }
      return false;
    }

    public function hasPermiso($permiso){
      if($this->permissions()->where('name',$permiso)->first()){
        return true;
      }
      return false;
    }
}
