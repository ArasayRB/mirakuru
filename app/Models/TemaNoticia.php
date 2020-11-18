<?php

namespace App\Models;

use App\Models\Noticia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemaNoticia extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function noticias(){
      return hasMany(Noticia::class)->withTimestamps();
    }
}
