<?php

namespace App\Models;

use App\Models\CalificacionCommentHostal;
use App\Models\Hostal;
use App\Models\User;
use App\Models\IndiceComentarioHostal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioHostal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'comment',
        'url_video',
        'hostal_id',
    ];

    public function hostales(){
      return $this->belongsTo(Hostal::class,'hostal_id')->withTimestamps();
    }

    public function users(){
      return $this->belongsTo(User::class,'user_id')->withTimestamps();
    }

    public function CalificacionCommentHostals(){
      return $this->belongsToMany(CalificacionCommentHostal::class,'calificacion_indice_comment_hostal','comment_id','calificacion_id')->withPivot('indice_id')->withTimestamps();
    }

    public function indicesComentario(){
      return $this->belongsToMany(IndiceComentarioHostal::class,'calificacion_indice_comment_hostal','comment_id','indice_id')->withPivot('calificacion_id')->withTimestamps();
    }
}
