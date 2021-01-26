<?php

namespace App\Models;

use App\Models\CalificacionCommentHostal;
use App\Models\Hostal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioHostal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'comment',
        'url_video',
        'calification_id',
        'hostal_id',
    ];

    public function hostales(){
      return $this->belongsTo(Hostal::class,'hostal_id')->withTimestamps();
    }

    public function users(){
      return $this->belongsTo(User::class,'user_id')->withTimestamps();
    }

    public function CalificacionCommentHostals(){
      return $this->belongsTo(CalificacionCommentHostal::class)->withTimestamps();
    }
}
