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
        $permission_client = Permission::where('name', 'Insert Post')->first();
        $permission_admin = Permission::where('name', 'Update Post')->first();
        $permission_posts = Permission::where('name', 'Delete Post')->first();

        $role=new Role();
        $role->name='Admin';
        $role->description='Administrador';
        $role->slug='admin';
        $role->save();
        $role->permissions()->attach($permission_client);

        $role=new Role();
        $role->name='Client';
        $role->description='Client';
        $role->slug='client';
        $role->save();
        $role->permissions()->attach($permission_admin);

        $role=new Role();
        $role->name='Viewer Content';
        $role->description='Revisor de contenido';
        $role->slug='viewer-content';
        $role->save();
        $role->permissions()->attach($permission_posts);

        $role=new Role();
        $role->name='Writer Content';
        $role->description='Escritor de contenido';
        $role->slug='writer-content';
        $role->save();
        $role->permissions()->attach($permission_posts);

        $role=new Role();
        $role->name='Publisher Content';
        $role->description='Publicador de contenido';
        $role->slug='publisher-content';
        $role->save();
        $role->permissions()->attach($permission_posts);
    }
}
