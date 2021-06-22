<?php

namespace App\Models;

use App\Models\Hostal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
    ];

    public function hostales(){
      return $this->belongsToMany(Hostal::class,'hostal_suscripcion','suscripcion_id','hostal_id')->withTimestamps();
    }
}
