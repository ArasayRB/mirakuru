<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class FileType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ext_available',
    ];

    public function files(){
      return $this->hasMany(File::class)->withTimestamps();
    }
}
