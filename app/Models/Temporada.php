<?php

namespace App\Models;


use App\Models\Hostal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'date_in',
        'date_out',
    ];



    public function hostales(){
      return $this->belongsToMany(Hostal::class,'hostal_temporada','temporada_id','hostal_id')->withPivot('active','active_date','inactive_date')->withTimestamps();
    }
}
