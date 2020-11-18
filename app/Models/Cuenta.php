<?php

namespace App\Models;

use App\Models\Cash;
use App\Models\TipoCuenta;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_account',
        'numberaccount',
        'user_id',
        'amount',
        'cash_id',
    ];

    public function usuarios(){
      return belongsTo(User::class)->withTimestamps();
    }

    public function tipoCuentas(){
      return belongsTo(TipoCuenta::class)->withTimestamps();
    }

    public function cashes(){
      return belongsTo(Cash::class)->withTimestamps();
    }
}
