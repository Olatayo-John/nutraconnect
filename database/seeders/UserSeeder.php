<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use UserTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create admin
        $admin = User::factory()->create([
            'name' => 'AdminName',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345')
        ]);

        $dbRole = Role::where('name', 'Admin')->pluck('id')->toArray();
        $admin->role()->sync($dbRole);

        //permission for user according to role
        $this->InitialUserRolePermission($admin);

        //random users
        User::factory(5)->create()->each(function ($user) {
            //create role for user
            // $dbUserRole = Role::where('name', 'User')->pluck('id')->toArray();
            // $user->role()->sync($dbUserRole);

            //permission for user according to role
            // $this->InitialUserRolePermission($user);
        });
    }
}
