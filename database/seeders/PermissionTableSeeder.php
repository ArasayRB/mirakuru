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
      $permission->name='Insert Post';
      $permission->slug='insertar-post';
      $permission->description='Obtiene todos los permisos sobre posts';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Post';
      $permission->slug='update-post';
      $permission->description='Acceso a actualizar posts';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Post';
      $permission->slug='delete-post';
      $permission->description='Acceso a eliminar posts';
      $permission->save();
    }
}
