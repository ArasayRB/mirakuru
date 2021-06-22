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
      $permission->name='Create Post';
      $permission->slug='create-post';
      $permission->description='Obtiene acceso a insertar post';
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

      $permission=new Permission();
      $permission->name='Publish Post';
      $permission->slug='publish-post';
      $permission->description='Acceso a publicar posts';
      $permission->save();

      $permission=new Permission();
      $permission->name='Pre View Post';
      $permission->slug='pre-view-post';
      $permission->description='Acceso a ver vista previa del post';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Post';
      $permission->slug='list-post';
      $permission->description='Acceso a ver listado de posts';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Post Published';
      $permission->slug='list-post-published';
      $permission->description='Acceso a ver listado de posts publicados';
      $permission->save();

      $permission=new Permission();
      $permission->name='Translate Post';
      $permission->slug='translate-post';
      $permission->description='Acceso a añadir traducción de un post en un idioma de los permitidos por la aplicacion';
      $permission->save();

      $permission=new Permission();
      $permission->name='Edit Translate Post';
      $permission->slug='edit-translate-post';
      $permission->description='Acceso a editar traducción de un post en un idioma de los permitidos por la aplicacion';
      $permission->save();

      $permission=new Permission();
      $permission->name='Creat Usuario';
      $permission->slug='creat-usuario';
      $permission->description='Acceso a crear usuario';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Usuario';
      $permission->slug='update-usuario';
      $permission->description='Acceso a actualizar usuario';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Usuario';
      $permission->slug='delete-usuario';
      $permission->description='Acceso a eliminar usuario';
      $permission->save();

      $permission=new Permission();
      $permission->name='List User';
      $permission->slug='list-user';
      $permission->description='Acceso a ver listado de users';
      $permission->save();

      $permission=new Permission();
      $permission->name='Create Role';
      $permission->slug='create-role';
      $permission->description='Acceso a crear role';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Role';
      $permission->slug='update-role';
      $permission->description='Acceso a actualizar role';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Role';
      $permission->slug='delete-role';
      $permission->description='Acceso a eliminar role';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Roles';
      $permission->slug='list-roles';
      $permission->description='Acceso a ver listado de roles';
      $permission->save();

      $permission=new Permission();
      $permission->name='Create Permission';
      $permission->slug='create-permission';
      $permission->description='Acceso a crear permission';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Permission';
      $permission->slug='update-permission';
      $permission->description='Acceso a actualizar permission';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Permission';
      $permission->slug='delete-permission';
      $permission->description='Acceso a actualizar permission';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Permission';
      $permission->slug='list-permission';
      $permission->description='Acceso a ver listado de permissions';
      $permission->save();

      $permission=new Permission();
      $permission->name='Admin Settings';
      $permission->slug='admin-settings';
      $permission->description='Acceso a administrar todas las configuraciones de la aplicacion y a todas ';
      $permission->save();
    }
}
