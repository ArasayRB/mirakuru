<?php

namespace App\Models;

use App\Models\ComentarioHostal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionCommentHostal extends Model
{
    use HasFactory;//calification,description,img_url
    protected $fillable = [
        'calification',
        'description',
        'img_url',
    ];

    public function comentariosHostals(){
      return hasMany(ComentarioHostal::class)->withTimestamps();
    }
}
