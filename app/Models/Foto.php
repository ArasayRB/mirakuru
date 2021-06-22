<?php

namespace App\Models;

use App\Models\AreaPicture;
use App\Models\Hostal;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends File
{
    use HasFactory;
    protected $fillable = [
        'name',
        'qr_img_web_url',
        'description',
        'slug',
        'img_url',
        'hostal_id',
        'area_id',
        'ppal'
    ];

    public function hostales(){
      return $this->belongsTo(Hostal::class,'hostal_id')->withTimestamps();
    }
    public function areas(){
      return $this->belongsTo(AreaPicture::class,'area_id')->withTimestamps();
    }

}
