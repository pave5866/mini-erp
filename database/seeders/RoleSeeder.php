<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Admin kullanıcısı oluştur
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@mini-erp.test',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ADMIN,
            'status' => true
        ]);

        // Yönetici kullanıcısı oluştur
        User::create([
            'name' => 'Manager User',
            'email' => 'manager@mini-erp.test',
            'password' => bcrypt('password'),
            'role' => User::ROLE_MANAGER,
            'status' => true
        ]);

        // Çalışan kullanıcısı oluştur
        User::create([
            'name' => 'Employee User',
            'email' => 'employee@mini-erp.test',
            'password' => bcrypt('password'),
            'role' => User::ROLE_EMPLOYEE,
            'status' => true
        ]);
    }
} 