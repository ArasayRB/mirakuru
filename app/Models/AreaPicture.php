<?php

namespace App\Models;


use App\Models\Foto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaPicture extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function fotos(){
      return hasMany(Foto::class)->withTimestamps();
    }
}
