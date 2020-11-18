<?php

namespace App\Models;

use App\Models\Keyword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeywordConfig extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_publicacion',
        'cant_max_words',
        'cant_min_words',
    ];

    public function keywords(){
      return belongsToMany(Keyword::class)->withTimestamps();
    }
}
