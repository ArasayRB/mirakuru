<?php

namespace App\Models;

use App\Models\WhyBlockedDate;
use App\Models\Hostal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedDate extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'date_in',
        'cant_days',
        'why_blocked_id',
    ];

    public function whyBlockeds(){
      return belongsTo(WhyBlockedDate::class)->withTimestamps();
    }

    public function hostales(){
      return belongsToMany(Hostal::class,'blocked_date_hostal','blocked_day_id','hostal_id')->withPivot('active','active_date','inactive_date')->withTimestamps();
    }
}
