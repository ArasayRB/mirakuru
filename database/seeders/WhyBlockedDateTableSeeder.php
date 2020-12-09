<?php

namespace Database\Seeders;

use App\Models\WhyBlockedDate;
use Illuminate\Database\Seeder;

class WhyBlockedDateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $why_blocked=new WhyBlockedDate();
      $why_blocked->name='Blocked before each book';
      $why_blocked->save();

      $why_blocked=new WhyBlockedDate();
      $why_blocked->name='Blocked after each book';
      $why_blocked->save();

      $why_blocked=new WhyBlockedDate();
      $why_blocked->name='Blocked by holidays';
      $why_blocked->save();

      $why_blocked=new WhyBlockedDate();
      $why_blocked->name='Blocked by party days';
      $why_blocked->save();

      $why_blocked=new WhyBlockedDate();
      $why_blocked->name='Blocked by exceptional situation';
      $why_blocked->save();
    }
}
