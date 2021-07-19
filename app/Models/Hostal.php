<?php

namespace App\Models;

use App\Models\Foto;
use App\Models\Habitacion;
use App\Models\Contacto;
use App\Models\BlockedDate;
use App\Models\Keyword;
use App\Models\Noticia;
use App\Models\Oferta;
use App\Models\Pago;
use App\Models\PublicacionHostal;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Suscripcion;
use App\Models\ClosePlace;
use App\Models\User;
use App\Models\Facility;
use App\Models\Owner;
use App\Models\Temporada;
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

    public function scopeFilterByNameAdress($query,$filter){
      if(!empty($filter)){
        $query->where('name', 'LIKE', '%'.$filter.'%')
                        ->orWhere('address', 'LIKE', '%'.$filter.'%');
      }
    }

    public function users(){
      return $this->belongsTo(User::class)->withTimestamps();
    }

    public function temporadas(){
      return $this->belongsToMany(Temporada::class,'hostal_temporada','hostal_id','temporada_id')->withPivot('active','active_date','inactive_date')->withTimestamps();
    }

    public function owners(){
      return $this->belongsToMany(Owner::class,'hostal_owner','hostal_id','owner_id')->withTimestamps();
    }

    public function keywords(){
      return $this->belongsToMany(Keyword::class)->withTimestamps();
    }

    public function services(){
      return $this->belongsToMany(Servicio::class,'hostal_servicio','hostal_id','servicio_id')->withPivot('cant_personas','active','active_date','inactive_date')->withTimestamps();
    }

    public function closePlaces(){
      return $this->belongsToMany(ClosePlace::class,'close_place_hostal','hostal_id','close_place_id')->withPivot('distance_km','distance_walking')->withTimestamps();
    }

    public function facilities(){
      return $this->belongsToMany(Facility::class,'facility_hostal','hostal_id','facility_id')->withPivot('price')->withTimestamps();
    }

    public function contactos(){
      return $this->hasMany(Contacto::class)->withTimestamps();
    }

    public function blockedDates(){
      return $this->belongsToMany(BlockedDate::class,'blocked_date_hostal','hostal_id','blocked_day_id')->withPivot('active','active_date','inactive_date')->withTimestamps();
    }

    public function habitaciones(){
      return $this->hasMany(Habitacion::class)->withTimestamps();
    }

    public function fotos(){
      return $this->hasMany(Foto::class)->withTimestamps();
    }

    public function noticias(){
      return $this->hasMany(Noticia::class)->withTimestamps();
    }

    public function ofertas(){
      return $this->hasMany(Oferta::class)->withTimestamps();
    }

    public function reservas(){
      return $this->hasMany(Reserva::class)->withTimestamps();
    }

    public function pagos(){
      return $this->hasMany(Pago::class)->withTimestamps();
    }

    public function publicaciones(){
      return $this->hasMany(PublicacionHostal::class)->withTimestamps();
    }

    public function suscripciones(){
      return $this->belongsToMany(Suscripcion::class,'hostal_suscripcion','hostal_id','suscripcion_id')->withTimestamps();
    }
}
