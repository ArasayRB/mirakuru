<?php

namespace App\Models;

use App\Models\Pago;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    use HasFactory;//name_comission,amount_porcent
    use HasFactory;//user_id,hostal_id,reserva_id,partials,payed_amount,date_payed
    protected $fillable = [
        'name_comission',
        'amount_porcent',
    ];

    public function pagos(){
      return belongsToMany(Pago::class)->withTimestamps();
    }
}
