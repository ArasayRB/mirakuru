<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $permission=new Permission();
      $permission->name='all';
      $permission->description='Obtiene todos los permisos sobre la aplicacion';
      $permission->save();

      $permission=new Permission();
      $permission->name='/';
      $permission->description='Acceso a la página principal luego de login';
      $permission->save();

      $permission=new Permission();
      $permission->name='/posts';
      $permission->description='Acceso a la página principal de posts';
      $permission->save();
    }
}
