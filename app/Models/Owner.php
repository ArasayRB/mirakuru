<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hostal;
use App\Models\User;

class Owner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'cel',
        'img_url',
        'profile',
    ];

    public function hostals(){
      return $this->belongsToMany(Hostal::class,'hostal_owner','owner_id','hostal_id')->withTimestamps();
    }

    public function users(){
      return $this->hasOne(User::class,'owner_user','owner_id','user_id');
    }
}
