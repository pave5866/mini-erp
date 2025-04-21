<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bireysel müşteriler
        $individuals = [
            [
                'name' => 'Ahmet Yılmaz',
                'email' => 'ahmet.yilmaz@example.com',
                'phone' => '05321234567',
                'address' => 'Atatürk Cad. No:123 Kadıköy',
                'city' => 'İstanbul',
                'country' => 'TR',
                'tax_number' => '12345678901',
                'notes' => 'Düzenli müşteri',
                'status' => 'active',
            ],
            [
                'name' => 'Ayşe Demir',
                'email' => 'ayse.demir@example.com',
                'phone' => '05331234567',
                'address' => 'Bağdat Cad. No:456 Maltepe',
                'city' => 'İstanbul',
                'country' => 'TR',
                'tax_number' => '12345678902',
                'notes' => 'Düzenli müşteri, VIP',
                'status' => 'active',
            ],
            [
                'name' => 'Mehmet Kaya',
                'email' => 'mehmet.kaya@example.com',
                'phone' => '05341234567',
                'address' => 'Cumhuriyet Mah. No:789 Beylikdüzü',
                'city' => 'İstanbul',
                'country' => 'TR',
                'tax_number' => '12345678903',
                'notes' => 'Yeni müşteri',
                'status' => 'active',
            ],
        ];

        // Kurumsal müşteriler
        $corporates = [
            [
                'name' => 'ABC Teknoloji Ltd. Şti.',
                'email' => 'info@abcteknoloji.com',
                'phone' => '02121234567',
                'address' => 'Levent Mah. No:123 Beşiktaş',
                'city' => 'İstanbul',
                'country' => 'TR',
                'tax_number' => '1234567890',
                'notes' => 'Büyük kurumsal müşteri',
                'status' => 'active',
            ],
            [
                'name' => 'XYZ Yazılım A.Ş.',
                'email' => 'info@xyzyazilim.com',
                'phone' => '02161234567',
                'address' => 'Esentepe Mah. No:456 Şişli',
                'city' => 'İstanbul',
                'country' => 'TR',
                'tax_number' => '1234567891',
                'notes' => 'Uzun süreli iş ortağı, VIP',
                'status' => 'active',
            ],
            [
                'name' => 'Mega Market Zinciri',
                'email' => 'info@megamarket.com',
                'phone' => '02321234567',
                'address' => 'Alsancak Mah. No:123',
                'city' => 'İzmir',
                'country' => 'TR',
                'tax_number' => '1234567892',
                'notes' => 'Çok şubeli müşteri',
                'status' => 'active',
            ],
        ];

        // Bireysel müşterileri ekle
        foreach ($individuals as $customer) {
            Customer::create($customer);
        }

        // Kurumsal müşterileri ekle
        foreach ($corporates as $customer) {
            Customer::create($customer);
        }

        // Not: Factory henüz oluşturulmadı
        // Customer::factory(15)->create();
    }
} 