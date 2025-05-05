<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = 
        $arrPermissions = [];
        
        foreach(config('bee.spatie.roles') as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            foreach(config('bee.spatie.actions') as $action) {
                $permissionName = $action.'_'.$roleName;
                $permission = Permission::firstOrcreate(['name' => $permissionName]);
                array_push($arrPermissions,$permissionName);
            }
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        if($superAdmin)
            $superAdmin->syncPermissions($arrPermissions);
  
    }
}
