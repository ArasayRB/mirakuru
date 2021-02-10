<?php

namespace App\Models;

use App\Models\CategoriaPost;
use App\Models\File;
use App\Models\ComentarioPost;
use App\Models\Keyword;
use App\Models\User;
use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; use Taggable;
    protected $fillable = [
        'title',
        'default_lang',
        'content',
        'summary',
        'publicate_state',
        'img_url',
        'video_url',
        'qr_img_url',
        'user_id',
        'category_id',
        'cant_access_read',
        'cant_likes',
        'cant_shares',
        'tags',
        'slug',
        'keywords',
    ];

    public function users(){
      return $this->belongsTo(User::class,'user_id');
    }

    
    public function categoriaPosts(){
      return $this->belongsTo('App\Models\CategoriaPost','category_id');
    }

    public function keywords(){
      return $this->belongsToMany(Keyword::class)->withTimestamps();
    }

    public function comentarioPosts(){
      return $this->hasMany(ComentarioPost::class)->withTimestamps();
    }

    public function files(){
      return $this->belongsToMany(File::class)->withTimestamps();
    }
}
