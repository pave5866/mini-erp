<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'company_name' => 'Tech Components Ltd.',
                'contact_name' => 'Ahmet Yılmaz',
                'email' => 'info@techcomponents.com',
                'phone' => '+90 212 555 0001',
                'address' => 'Maslak Mah. Büyükdere Cad. No:1',
                'city' => 'İstanbul',
                'country' => 'Türkiye',
                'tax_number' => '1234567890',
                'tax_office' => 'Maslak',
                'website' => 'www.techcomponents.com',
                'payment_terms' => 30,
                'notes' => 'Bilgisayar ve elektronik parça tedarikçisi',
                'status' => true
            ],
            [
                'company_name' => 'Office Solutions A.Ş.',
                'contact_name' => 'Mehmet Demir',
                'email' => 'info@officesolutions.com.tr',
                'phone' => '+90 216 555 0002',
                'address' => 'Kadıköy Mah. Bağdat Cad. No:2',
                'city' => 'İstanbul',
                'country' => 'Türkiye',
                'tax_number' => '9876543210',
                'tax_office' => 'Kadıköy',
                'website' => 'www.officesolutions.com.tr',
                'payment_terms' => 45,
                'notes' => 'Ofis malzemeleri ve mobilya tedarikçisi',
                'status' => true
            ],
            [
                'company_name' => 'Software Plus',
                'contact_name' => 'Ayşe Kaya',
                'email' => 'info@softwareplus.com.tr',
                'phone' => '+90 312 555 0003',
                'address' => 'Çankaya Mah. Atatürk Cad. No:3',
                'city' => 'Ankara',
                'country' => 'Türkiye',
                'tax_number' => '4567891230',
                'tax_office' => 'Çankaya',
                'website' => 'www.softwareplus.com.tr',
                'payment_terms' => 15,
                'notes' => 'Yazılım lisans ve çözümleri tedarikçisi',
                'status' => true
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Not: Factory henüz oluşturulmadı
        // Supplier::factory(4)->create();
    }
} 