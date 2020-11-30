<?php

namespace App\Models;

use App\Models\Foto;
use App\Models\Habitacion;
use App\Models\Keyword;
use App\Models\Noticia;
use App\Models\Oferta;
use App\Models\Pago;
use App\Models\PublicacionHostal;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Suscripcion;
use App\Models\User;
use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostal extends Model
{
    use HasFactory; use Taggable;
    protected $fillable = [
        'name',
        'phone',
        'address',
        'img_ppal_url',
        'qr_img_web_url',
        'active',
        'email',
        'user_id',
        'tags',
        'slug',
        'keywords',
    ];

    public function users(){
      return belongsTo(User::class)->withTimestamps();
    }

    public function keywords(){
      return hasMany(Keyword::class)->withTimestamps();
    }

    public function services(){
      return belongsToMany(Servicio::class)->withTimestamps();
    }

    public function habitaciones(){
      return hasMany(Habitacion::class)->withTimestamps();
    }

    public function fotos(){
      return hasMany(Foto::class)->withTimestamps();
    }

    public function noticias(){
      return hasMany(Noticia::class)->withTimestamps();
    }

    public function ofertas(){
      return hasMany(Oferta::class)->withTimestamps();
    }

    public function reservas(){
      return hasMany(Reserva::class)->withTimestamps();
    }

    public function pagos(){
      return hasMany(Pago::class)->withTimestamps();
    }

    public function publicaciones(){
      return hasMany(PublicacionHostal::class)->withTimestamps();
    }

    public function suscripciones(){
      return belongsToMany(User::class,'suscripcions','hostal_id','user_id')->withTimestamps();
    }
}
