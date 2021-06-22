<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ContentType;
use App\Models\Language;

class Translate extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_content_trans',
        'content',
        'tipo_content',
        'trans_lang',
        'indice_content',
        'content_trans',
    ];

    public function languages(){
      return $this->belongsToMany(Language::class,'translate_language','translate_id','language_id')->withPivot('content_trans','id')->withTimestamps();
    }

    public function contents(){
      return $this->belongsTo(ContentType::class,'tipo_content')->withTimestamps();
    }
}
