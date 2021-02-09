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
      $role_client = Role::with('permissions')
                          ->where('name', 'Client')->first();
      $role_admin = Role::with('permissions')
                          ->where('name', 'Admin')->first();
      $role_viewer = Role::with('permissions')
                          ->where('name', 'Viewer Content')->first();
      $role_writer = Role::with('permissions')
                          ->where('name', 'Writer Content')->first();
      $role_publisher = Role::with('permissions')
                          ->where('name', 'Publisher Content')->first();

      $user = new User();
      $user->name = 'User';
      $user->email = 'user@example.com';
      $user->password = bcrypt('secret/*1234');
      $user->save();
      $user->roles()->attach($role_client);
      foreach ($role_client->permissions as $permission) {
        $user->permissions()->attach($permission);
      }

      $user = new User();
      $user->name = 'Admin';
      $user->email = 'admin@example.com';
      $user->password = bcrypt('secret/*1234');
      $user->save();
      $user->roles()->attach($role_admin);
      foreach ($role_admin->permissions as $permission) {
        $user->permissions()->attach($permission);
      }

      $user = new User();
      $user->name = 'Ana Lidia Fernandez';
      $user->email = 'ana@example.com';
      $user->password = bcrypt('secret/*1234');
      $user->save();
      $user->roles()->attach($role_viewer);
      foreach ($role_viewer->permissions as $permission) {
        $user->permissions()->attach($permission);
      }

      $user = new User();
      $user->name = 'Ramón Gonzalez';
      $user->email = 'ramonglez@example.com';
      $user->password = bcrypt('secret/*1234');
      $user->save();
      $user->roles()->attach($role_writer);
      foreach ($role_writer->permissions as $permission) {
        $user->permissions()->attach($permission);
      }

      $user = new User();
      $user->name = 'Teresa Díaz Rodríguez';
      $user->email = 'teresa_dr@example.com';
      $user->password = bcrypt('secret/*1234');
      $user->save();
      $user->roles()->attach($role_publisher);
      foreach ($role_publisher->permissions as $permission) {
        $user->permissions()->attach($permission);
      }

      $user = new User();
      $user->name = 'Julio Cuevas';
      $user->email = 'julio@example.com';
      $user->password = bcrypt('secret/*1234');
      $user->save();
      $user->roles()->attach($role_admin);
      foreach ($role_admin->permissions as $permission) {
        $user->permissions()->attach($permission);
      }

      $user = new User();
      $user->name = 'Javier Hernández Díaz';
      $user->email = 'javi@example.com';
      $user->password = bcrypt('secret/*1234');
      $user->save();
      $user->roles()->attach($role_viewer);
      foreach ($role_viewer->permissions as $permission) {
        $user->permissions()->attach($permission);
      }
    }
}
