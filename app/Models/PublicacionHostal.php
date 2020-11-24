<?php

namespace App\Models;

use App\Models\Hostal;
use App\Models\Keyword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicacionHostal extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'img_url',
        'video_url',
        'qr_img_url',
        'hostal_id',
        'tags',
    ];

    public function hostales(){
      return belongsTo(Hostal::class)->withTimestamps();
    }

    public function keywords(){
      return hasMany(Keyword::class)->withTimestamps();
    }
}
