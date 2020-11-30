<?php

namespace App\Models;

use App\Models\File;
use App\Models\Hostal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price_high',
        'price_low',
        'name_contact',
        'person_min',
        'person_max',
    ];

    public function hostales(){
      return belongsToMany(Hostal::class)->withTimestamps();
    }

    public function files(){
      return $this->belongsToMany(File::class)->withTimestamps();
    }
}
