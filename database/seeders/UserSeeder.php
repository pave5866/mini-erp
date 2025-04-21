<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin kullanıcısı
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'department' => 'IT',
            'position' => 'System Administrator',
            'status' => true,
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Yönetici kullanıcısı
        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'department' => 'Yönetim',
            'position' => 'Genel Müdür',
            'status' => true,
            'email_verified_at' => now(),
        ]);
        $manager->assignRole('manager');

        // Satış personeli
        $sales = User::create([
            'name' => 'Sales User',
            'email' => 'sales@example.com',
            'password' => Hash::make('password'),
            'department' => 'Satış',
            'position' => 'Satış Temsilcisi',
            'status' => true,
            'email_verified_at' => now(),
        ]);
        $sales->assignRole('sales');

        // Depo personeli
        $stock = User::create([
            'name' => 'Stock User',
            'email' => 'stock@example.com',
            'password' => Hash::make('password'),
            'department' => 'Depo',
            'position' => 'Depo Sorumlusu',
            'status' => true,
            'email_verified_at' => now(),
        ]);
        $stock->assignRole('stock');

        // Muhasebe personeli
        $accounting = User::create([
            'name' => 'Accounting User',
            'email' => 'accounting@example.com',
            'password' => Hash::make('password'),
            'department' => 'Muhasebe',
            'position' => 'Muhasebe Uzmanı',
            'status' => true,
            'email_verified_at' => now(),
        ]);
        $accounting->assignRole('accounting');
    }
} 