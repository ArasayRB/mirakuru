<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_client = Role::where('name', 'client')->first();
      $role_admin = Role::where('name', 'admin')->first();

      $user = new User();
      $user->name = 'User';
      $user->email = 'user@example.com';
      $user->password = bcrypt('secret');
      $user->save();
      $user->roles()->attach($role_client);

      $user = new User();
      $user->name = 'Admin';
      $user->email = 'admin@example.com';
      $user->password = bcrypt('secret');
      $user->save();
      $user->roles()->attach($role_admin);
    }
}
