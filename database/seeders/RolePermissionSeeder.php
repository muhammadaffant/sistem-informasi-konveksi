<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Role::create(['name'=>'owner']);
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'user']);
        // $roleAdmin = Role::findByName('admin');
    }
}
