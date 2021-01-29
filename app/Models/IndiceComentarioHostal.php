<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ComentarioHostal;
use App\Models\CalificacionCommentHostal;

class IndiceComentarioHostal extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function comentarios(){
      return $this->belongsToMany(ComentarioHostal::class,'calificacion_indice_comment_hostal','indice_id','comment_id')->withPivot('calificacion_id')->withTimestamps();
    }

    public function calificaciones(){
      return $this->belongsToMany(CalificacionCommentHostal::class,'calificacion_indice_comment_hostal','indice_id','calificacion_id')->withPivot('comment_id')->withTimestamps();
    }
}
