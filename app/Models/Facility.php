<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hostal;

class Facility extends Model
{
    use HasFactory;protected $fillable = [
        'name',
        'description',
        'img',
    ];

    public function hostals(){
      return $this->belongsToMany(Hostal::class,'facility_hostal','facility_id','hostal_id')->withPivot('price')->withTimestamps();
    }
}
