<?php

namespace App\Models;

use App\Models\File;
use App\Models\Hostal;
use App\Models\Keyword;
use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicacionHostal extends Model
{
    use HasFactory; use Taggable;
    protected $fillable = [
        'title',
        'content',
        'img_url',
        'video_url',
        'qr_img_url',
        'publicate_state',
        'hostal_id',
        'tags',
        'slug',
        'keywords',
    ];

    public function hostales(){
      return belongsTo(Hostal::class)->withTimestamps();
    }

    public function keywords(){
      return hasMany(Keyword::class)->withTimestamps();
    }

    public function files(){
      return $this->belongsToMany(File::class)->withTimestamps();
    }
}
