<?php

namespace App\Models;

use App\Models\BlockedDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyBlockedDate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function blockeds(){
      return hasMany(BlockedDate::class)->withTimestamps();
    }
}
