<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'permission_id',
        'user_id',
    ];

    public function roles(){
      return $this->belongsToMany(Role::class,'permission_role','permission_id','role_id')->withTimestamps();
    }

    public function users(){
      return $this->belongsToMany(User::class,'permission_user','permission_id','user_id')->withTimestamps();
    }
}
