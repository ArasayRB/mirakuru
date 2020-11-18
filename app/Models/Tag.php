<?php

namespace App\Models;

use App\Models\Noticia;
use App\Models\PublicacionHostal;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'count',
        'url_tag'
    ];

    public function noticias(){
      return belongsToMany(Noticia::class)->withTimestamps();
    }

    public function publicaciones(){
      return belongsToMany(PublicacionHostal::class)->withTimestamps();
    }

    public function posts(){
      return belongsToMany(Post::class)->withTimestamps();
    }
}
