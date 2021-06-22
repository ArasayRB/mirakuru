<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hostal;

class Contacto extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'name',
        'mensage',
        'hostal_id',
    ];

    public function hostales(){
      return $this->belongsTo(Hostal::class)->withTimestamps();
    }
}
