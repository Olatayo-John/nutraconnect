<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('site.permissions') as $permission) {
            $dbPermission= Permission::create([
                'name_key' => $permission['name_key'],
                'name' => $permission['name'],
                'controller' => $permission['controller'],
                'method' => $permission['method'],
            ]);

            $dbRole= Role::whereIn('name',$permission['roles'])->get();

            foreach ($dbRole as $role) {
                $role->permissions()->attach([$dbPermission->id]);
            }
        }
    }
}
