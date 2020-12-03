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
        'rooms',
        'adress',
        'phone',
        'active',
        'amount',
        'hostal_id',
    ];

    public function hostales(){
      return belongsTo(Hostal::class)->withTimestamps();
    }

    public function usuarios(){
      return belongsTo(User::class)->withTimestamps();
    }

    public function pagos(){
      return hasOne(Pago::class)->withTimestamps();
    }

    public function habitaciones(){
      return belongsToMany(Habitacion::class,'habitacion_reserva','reserva_id','habitacion_id')->withPivot('active','active_date','inactive_date')->withTimestamps();
    }

    public function servicios(){
      return hasManyThrough(Servicio::class,Hostal::class);
    }

    public function countries(){
      return belongsTo(Country::class)->withTimestamps();
    }
}
