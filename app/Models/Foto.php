<?php

namespace App\Models;

use App\Models\AreaPicture;
use App\Models\Hostal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'img_url',
        'hostal_id',
        'area_id',
    ];

    public function hostales(){
      return belongsTo(Hostal::class)->withTimestamps();
    }
    public function areas(){
      return belongsTo(AreaPicture::class)->withTimestamps();
    }
}
