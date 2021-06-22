<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hostal;

class ClosePlace extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description_place',
        'img',
    ];


    public function hostales(){
      return $this->belongsToMany(Hostal::class,'close_place_hostal','close_place_id','hostal_id')->withPivot('distance_km','distance_walking')->withTimestamps();
    }
}
