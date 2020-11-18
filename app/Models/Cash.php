<?php

namespace App\Models;

use App\Models\Cuenta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function cuentas(){
      return hasMany(Cuenta::class)->withTimestamps();
    }
}
