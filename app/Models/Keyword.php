<?php

namespace App\Models;

use App\Models\Hostal;
use App\Models\KeywordConfig;
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
        'keyconfig_id',
    ];

    public function hostales(){
      return belongsToMany(Hostal::class)->withTimestamps();
    }

    public function keywordsconfigs(){
      return belongsTo(KeywordConfig::class)->withTimestamps();
    }

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
