<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\Hostal;
use App\Models\User;

class OwnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner=new Owner();
        $owner->name='Arasay Rodriguez Bastida';
        $owner->email='arasay@example.com';
        $owner->cel='53419001';
        $owner->save();
        $owner->hostals()->attach(1);

        $owner=new Owner();
        $owner->name='Youblián Cuevas Aróstica';
        $owner->email='youblian@example.com';
        $owner->cel='52474269';
        $owner->save();
        $owner->hostals()->attach(1);
    }
}
