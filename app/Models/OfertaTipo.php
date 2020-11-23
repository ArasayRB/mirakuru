<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Oferta;
use Illuminate\Database\Eloquent\Model;

class OfertaTipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public function ofertas(){
      return hasMany(Oferta::class)->withTimestamps();
    }
}
