<?php

namespace App\Models;

use App\Models\Hostal;
use App\Models\Keyword;
use App\Models\Tag;
use App\Models\TemaNoticia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'noticia',
        'publicate_state',
        'cant_access_read',
        'cant_likes',
        'cant_shares',
        'img_url',
        'video_url',
        'qr_img_url',
        'tema_id',
        'hostal_id',
    ];

    public function temas(){
      return belongsTo(TemaNoticia::class)->withTimestamps();
    }

    public function keywords(){
      return hasMany(Keyword::class)->withTimestamps();
    }

    public function hostales(){
      return belongsTo(Hostal::class)->withTimestamps();
    }

    public function tags(){
      return hasMany(Tag::class)->withTimestamps();
    }
}
