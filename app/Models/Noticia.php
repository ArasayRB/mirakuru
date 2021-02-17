<?php

namespace App\Models;

use App\Models\File;
use App\Models\Hostal;
use App\Models\Keyword;
use App\Models\TemaNoticia;
use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory; use Taggable;
    protected $fillable = [
        'title',
        'noticia',
        'description',
        'publicate_state',
        'cant_access_read',
        'cant_likes',
        'cant_shares',
        'img_url',
        'video_url',
        'qr_img_url',
        'tema_id',
        'hostal_id',
        'user_id',
        'tags',
        'slug',
        'keywords',
    ];

    public function temas(){
      return $this->belongsTo(TemaNoticia::class)->withTimestamps();
    }

    public function keywords(){
      return $this->hasMany(Keyword::class)->withTimestamps();
    }

    public function files(){
      return $this->belongsToMany(File::class)->withTimestamps();
    }

    public function hostales(){
      return $this->belongsTo(Hostal::class)->withTimestamps();
    }
}
