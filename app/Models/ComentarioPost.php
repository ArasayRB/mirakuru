<?php

namespace App\Models;

use App\Models\CalificacionCommentPost;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioPost extends Model
{
    use HasFactory;//email,fullName,comment,calification
    protected $fillable = [
        'email',
        'fullName',
        'comment',
        'calification_id',
        'post_id',
    ];

    public function posts(){
      return belongsTo(Post::class)->withTimestamps();
    }

    public function calificacionCommentPosts(){
      return belongsTo(CalificacionCommentPost::class)->withTimestamps();
    }
}
