<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permission_client = Permission::where('name', 'List Post Published')->first();
        $permission_content_viewer=[];
        $permission_content_viewer[] = Permission::where('name', 'List Post')->first();
        $permission_content_viewer[] = Permission::where('name', 'Pre View Post')->first();
        $permission_content_viewer[] =$permission_client;
        $permission_content_writer=$permission_content_viewer;
        $permission_content_writer[] = Permission::where('name', 'Create Post')->first();
        $permission_content_writer[] = Permission::where('name', 'Update Post')->first();
        $permission_content_writer[] = Permission::where('name', 'Delete Post')->first();
        $permission_content_writer[] = Permission::where('name', 'Translate Post')->first();
        $permission_content_writer[] = Permission::where('name', 'Edit Translate Post')->first();
        $permission_content_publisher=$permission_content_viewer;
        $permission_content_publisher[] = Permission::where('name', 'Publish Post')->first();
        $permission_posts = Permission::where('name', 'Delete Post')->first();
        $permission_all=Permission::all();

        $role=new Role();
        $role->name='Admin';
        $role->description='Administrador';
        $role->slug='admin';
        $role->save();
        foreach ($permission_all as $permission) {
          $role->permissions()->attach($permission);
        }

        $role=new Role();
        $role->name='Client';
        $role->description='Client';
        $role->slug='client';
        $role->save();
        $role->permissions()->attach($permission_client);

        $role=new Role();
        $role->name='Viewer Content';
        $role->description='Revisor de contenido';
        $role->slug='viewer-content';
        $role->save();
        foreach ($permission_content_viewer as $permission) {
          $role->permissions()->attach($permission);
        }

        $role=new Role();
        $role->name='Writer Content';
        $role->description='Escritor de contenido';
        $role->slug='writer-content';
        $role->save();
        foreach ($permission_content_writer as $permission) {
          $role->permissions()->attach($permission);
        }

        $role=new Role();
        $role->name='Publisher Content';
        $role->description='Publicador de contenido';
        $role->slug='publisher-content';
        $role->save();
        foreach ($permission_content_publisher as $permission) {
          $role->permissions()->attach($permission);
        }
    }
}
