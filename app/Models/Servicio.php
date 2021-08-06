<?php

namespace App\Models;


use App\Models\ServiceType;
use App\Models\File;
use App\Models\Hostal;
use App\Models\Reserva;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price_high',
        'price_low',
        'name_contact',
        'person_min',
        'person_max',
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->where('name', 'LIKE', '%'.$filter.'%');
      }
    }

    public function hostales(){
      return $this->belongsToMany(Hostal::class,'hostal_servicio','servicio_id','hostal_id')->withPivot('cant_personas','active','active_date','inactive_date')->withTimestamps();
    }

    public function servicioTypes(){
      return $this->belongsToMany(ServiceType::class,'servicio_service_type','servicio_id','service_type_id')->withTimestamps();
    }

    public function reservas(){
      return $this->belongsToMany(Reserva::class,'reserva_servicio','servicio_id','reserva_id')->withPivot('active','active_date','inactive_date','persons')->withTimestamps();
    }

    public function files(){
      return $this->belongsToMany(File::class)->withTimestamps();
    }
}
