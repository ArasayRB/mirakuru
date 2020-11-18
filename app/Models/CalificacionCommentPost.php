<?php

namespace App\Models;

use App\Models\ComentarioPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionCommentPost extends Model
{
    use HasFactory;//calification,description,img_url
    protected $fillable = [
        'calification',
        'description',
        'img_url',
    ];

    public function comentariosPosts(){
      return hasMany(ComentarioPost::class)->withTimestamps();
    }
}
