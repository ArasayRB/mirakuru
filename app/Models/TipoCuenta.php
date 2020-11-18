<?php

namespace App\Models;

use App\Models\Cuenta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCuenta extends Model
{
    use HasFactory;//name,how_validate
    protected $fillable = [
        'name',
        'how_validate',
    ];

    public function cuentas(){
      return hasMany(Cuenta::class)->withTimestamps();
    }
}
