<?php

namespace App\Models;

use App\Models\Hostal;
use App\Models\Pago;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_in',
        'date_out',
        'user_id',
        'totally_persons',
        'child',
        'service',
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
}
