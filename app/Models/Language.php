<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translate;

class Language extends Model
{
    use HasFactory;
    protected $fillable = [
        'language',
        'sigla',
    ];

    public function translates(){
      return belongsToMany(Translate::class,'translate_language','language_id','translate_id')->withPivot('content_trans','id')->withTimestamps();
    }
}
