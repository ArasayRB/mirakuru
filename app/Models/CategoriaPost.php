<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_post',
        'description',
    ];

    public function posts(){
      return hasMany(Post::class)->withTimestamps();
    }
}
