<?php

namespace App\Models;

use App\Models\Hostal;
use App\Models\Noticia;
use App\Models\PublicacionHostal;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function hostales(){
      return $this->belongsToMany(Hostal::class)->withTimestamps();
    }

    public function noticias(){
      return $this->belongsToMany(Noticia::class)->withTimestamps();
    }

    public function publicaciones(){
      return $this->belongsToMany(PublicacionHostal::class)->withTimestamps();
    }

    public function posts(){
      return $this->belongsToMany(Post::class)->withTimestamps();
    }

}
