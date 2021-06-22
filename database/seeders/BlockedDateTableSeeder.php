<?php

namespace Database\Seeders;

use App\Models\BlockedDate;
use Illuminate\Database\Seeder;

class BlockedDateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      $why_blocked=new BlockedDate();
      $why_blocked->description='Blocked before each book product COVID-19 for cleaning deep before arrive new guests';
      $why_blocked->cant_days=1;
      $why_blocked->why_blocked_id=1;
      $why_blocked->save();

      $why_blocked=new BlockedDate();
      $why_blocked->description='Blocked after each book';
      $why_blocked->cant_days=1;
      $why_blocked->why_blocked_id=2;
      $why_blocked->save();
    }
}
