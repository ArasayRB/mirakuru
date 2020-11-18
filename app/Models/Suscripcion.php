<?php

namespace App\Models;

use App\Models\Hostal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'fullName',
    ];

    public function hostales(){
      return belongsToMany(Hostal::class)->withTimestamps();
    }
}
