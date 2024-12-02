<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = User::create([
            'fullname' => 'owner',
            'username' => 'owner',
            'email' => 'owner@gmail.com',
            'password' =>bcrypt('12345678'),
            'is_verified' => true,
        ]);
        $owner->assignRole('owner');

        $admin = User::create([
            'fullname' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' =>bcrypt('12345678'),
            'is_verified' => true,
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'fullname' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' =>bcrypt('12345678'),
            'is_verified' => false,
        ]);
        $user->assignRole('user');
    }
}
