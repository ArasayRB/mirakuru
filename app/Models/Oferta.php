<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Hostal;
use App\Models\Keyword;
use App\Models\OfertaTipo;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'img_ppal_url',
        'qr_img_web_url',
        'active',
        'price',
        'fecha_inicio',
        'fecha_final',
        'hostal_id',
        'type_oferta_id',
        'tags',
    ];

    public function hostales(){
      return belongsTo(Hostal::class)->withTimestamps();
    }

    public function tipoOfertas(){
      return belongsTo(OfertaTipo::class)->withTimestamps();
    }

    public function keywords(){
      return hasMany(Keyword::class)->withTimestamps();
    }
}
