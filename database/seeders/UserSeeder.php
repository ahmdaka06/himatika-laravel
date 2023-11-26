<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ahmad Andika',
            'email' => 'ahmdaka@gmail.com',
            'password' => bcrypt('ahmdandika060402#'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin Kholid',
            'email' => 'adminkholid@gmail.com',
            'password' => bcrypt('adminkholid90001'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin Danang',
            'email' => 'admindanang@gmail.com',
            'password' => bcrypt('admindanang90001'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin Wahyu',
            'email' => 'adminwahyu@gmail.com',
            'password' => bcrypt('adminwahuyu90001'),
            'role' => 'admin',
        ]);
    }
}
