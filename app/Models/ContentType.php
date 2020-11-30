<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translate;

class ContentType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function translates(){
      return $this->hasMany(Translate::class)->withTimestamps();
    }
}
