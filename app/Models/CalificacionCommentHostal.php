<?php

namespace App\Models;

use App\Models\ComentarioHostal;
use App\Models\IndiceComentarioHostal;
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
      return belongsToMany(ComentarioHostal::class,'calificacion_indice_comment_hostal','calificacion_id','comment_id')->withPivot('indice_id')->withTimestamps();
    }

    public function indicesComentario(){
      return belongsToMany(IndiceComentarioHostal::class,'calificacion_indice_comment_hostal','calificacion_id','indice_id')->withPivot('comment_id')->withTimestamps();
    }
}
