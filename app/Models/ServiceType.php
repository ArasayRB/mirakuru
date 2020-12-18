<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio;

class ServiceType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public function servicios(){
      return $this->belongsToMany(Servicio::class,'servicio_service_type','service_type_id','servicio_id')->withTimestamps();
    }
}
