<?php

namespace App\Models;

use App\Models\Comision;
use App\Models\Hostal;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;//user_id,hostal_id,reserva_id,partials,payed_amount,date_payed
    protected $fillable = [
        'user_id',
        'hostal_id',
        'reserva_id',
        'partials',
        'payed_amount',
        'date_payed',
    ];

    public function reservaciones(){
      return belongsTo(Reserva::class)->withTimestamps();
    }

    public function users(){
      return belongsTo(User::class)->withTimestamps();
    }

    public function hostales(){
      return belongsTo(Hostal::class)->withTimestamps();
    }

    public function comisiones(){
      return belongsToMany(Comision::class)->withTimestamps();
    }
}
