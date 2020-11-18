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
        $permission_client = Permission::where('name', '/')->first();
        $permission_admin = Permission::where('name', 'all')->first();
        $permission_posts = Permission::where('name', '/posts')->first();

        $role=new Role();
        $role->name='admin';
        $role->description='Administrador';
        $role->save();
        $role->permissions()->attach($permission_client);

        $role=new Role();
        $role->name='client';
        $role->description='Client';
        $role->save();
        $role->permissions()->attach($permission_admin);

        $role=new Role();
        $role->name='viewer-content';
        $role->description='Revisor de contenido';
        $role->save();
        $role->permissions()->attach($permission_posts);

        $role=new Role();
        $role->name='writer-content';
        $role->description='Escritor de contenido';
        $role->save();
        $role->permissions()->attach($permission_posts);

        $role=new Role();
        $role->name='publisher-content';
        $role->description='Publicador de contenido';
        $role->save();
        $role->permissions()->attach($permission_posts);
    }
}
