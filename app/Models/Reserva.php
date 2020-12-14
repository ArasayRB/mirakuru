<?php

namespace App\Models;

use App\Models\Habitacion;
use App\Models\Hostal;
use App\Models\Servicio;
use App\Models\Country;
use App\Models\Pago;
use Conner\Tagging\Taggable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory; use Taggable;
    protected $fillable = [
        'date_in',
        'date_out',
        'user_id',
        'totally_persons',
        'country_id',
        'child',
        'service',
        'name',
        'rooms',
        'adress',
        'phone',
        'active',
        'amount',
        'hostal_id',
    ];

    public function hostales(){
      return $this->belongsTo(Hostal::class)->withTimestamps();
    }

    public function usuarios(){
      return $this->belongsTo(User::class)->withTimestamps();
    }

    public function pagos(){
      return $this->hasMany(Pago::class)->withTimestamps();
    }

    public function habitaciones(){
      return $this->belongsToMany(Habitacion::class,'habitacion_reserva','reserva_id','habitacion_id')->withPivot('active','active_date','inactive_date')->withTimestamps();
    }

    public function servicios(){
      return $this->belongsToMany(Servicio::class,'reserva_servicio','reserva_id','servicio_id')->withPivot('active','active_date','inactive_date','persons')->withTimestamps();
    }

    public function countries(){
      return $this->belongsTo(Country::class)->withTimestamps();
    }
}
