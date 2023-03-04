<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'client-list',
           'client-create',
           'client-edit',
           'client-delete',
           'notas-list',
           'notas-create',
           'notas-edit',
           'notas-delete',
           'usuarios-list',
           'usuarios-create',
           'usuarios-edit',
           'usuarios-delete',
           'servicios-list',
           'servicios-create',
           'servicios-edit',
           'servicios-delete',
           'configuracion'
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
