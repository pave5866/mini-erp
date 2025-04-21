<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Müşteri izinleri
        Permission::create(['name' => 'list customers']);
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'edit customers']);
        Permission::create(['name' => 'delete customers']);
        Permission::create(['name' => 'view customers']);

        // Tedarikçi izinleri
        Permission::create(['name' => 'list suppliers']);
        Permission::create(['name' => 'create suppliers']);
        Permission::create(['name' => 'edit suppliers']);
        Permission::create(['name' => 'delete suppliers']);
        Permission::create(['name' => 'view suppliers']);

        // Ürün izinleri
        Permission::create(['name' => 'list products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'view products']);

        // Stok izinleri
        Permission::create(['name' => 'list stocks']);
        Permission::create(['name' => 'create stocks']);
        Permission::create(['name' => 'edit stocks']);
        Permission::create(['name' => 'delete stocks']);
        Permission::create(['name' => 'view stocks']);

        // Satış izinleri
        Permission::create(['name' => 'list sales']);
        Permission::create(['name' => 'create sales']);
        Permission::create(['name' => 'edit sales']);
        Permission::create(['name' => 'delete sales']);
        Permission::create(['name' => 'view sales']);

        // Kullanıcı izinleri
        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view users']);

        // Raporlama izinleri
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'export reports']);

        // Roller oluşturuluyor
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $salesRole = Role::create(['name' => 'sales']);
        $stockRole = Role::create(['name' => 'stock']);
        $accountingRole = Role::create(['name' => 'accounting']);

        // Admin tüm izinlere sahip
        $adminRole->givePermissionTo(Permission::all());

        // Yönetici izinleri
        $managerRole->givePermissionTo([
            'list customers', 'create customers', 'edit customers', 'view customers',
            'list suppliers', 'create suppliers', 'edit suppliers', 'view suppliers',
            'list products', 'create products', 'edit products', 'view products',
            'list stocks', 'create stocks', 'edit stocks', 'view stocks',
            'list sales', 'create sales', 'edit sales', 'view sales',
            'view reports', 'export reports'
        ]);

        // Satış personeli izinleri
        $salesRole->givePermissionTo([
            'list customers', 'create customers', 'edit customers', 'view customers',
            'list products', 'view products',
            'list sales', 'create sales', 'edit sales', 'view sales',
            'view reports'
        ]);

        // Depo personeli izinleri
        $stockRole->givePermissionTo([
            'list products', 'edit products', 'view products',
            'list stocks', 'create stocks', 'edit stocks', 'view stocks',
            'view reports'
        ]);

        // Muhasebe personeli izinleri
        $accountingRole->givePermissionTo([
            'list customers', 'view customers',
            'list suppliers', 'view suppliers',
            'list sales', 'view sales',
            'view reports', 'export reports'
        ]);
    }
} 