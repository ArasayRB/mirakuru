<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FileType;
use App\Models\Noticia;
use App\Models\Oferta;
use App\Models\Post;
use App\Models\PublicacionHostal;
use App\Models\Servicio;
use App\Models\User;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'file',
        'description',
        'slug',
        'extencion',
        'downloads',
        'shares',
        'watches',
        'file_type',
    ];

    public function fileTypes(){
      return $this->belongsTo(FileType::class,'file_type')->withTimestamps();
    }

    public function noticias(){
      return $this->belongsToMany(Noticia::class)->withTimestamps();
    }

    public function ofertas(){
      return $this->belongsToMany(Oferta::class)->withTimestamps();
    }

    public function posts(){
      return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function pubicaciones(){
      return $this->belongsToMany(PublicacionHostal::class)->withTimestamps();
    }

    public function servicios(){
      return $this->belongsToMany(Servicio::class)->withTimestamps();
    }

    public function users(){
      return $this->belongsToMany(User::class)->withTimestamps();
    }
}
