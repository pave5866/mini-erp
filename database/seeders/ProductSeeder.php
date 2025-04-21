<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Elektronik > Akıllı Telefonlar
            [
                'name' => 'Samsung Galaxy S23 Ultra 256GB',
                'description' => 'Samsung Galaxy S23 Ultra 256GB Akıllı Telefon, 6.8 inç Ekran, Snapdragon 8 Gen 2',
                'sku' => 'SM-S23U-256-BLK',
                'barcode' => '8806094810097',
                'price' => 42999.90,
                'cost' => 35000.00,
                'tax_rate' => 18,
                'stock_quantity' => 25,
                'min_stock_level' => 5,
                'category_name' => 'Akıllı Telefonlar',
                'supplier_name' => 'Tech Components Ltd.',
                'featured' => true,
            ],
            [
                'name' => 'iPhone 14 Pro 128GB',
                'description' => 'Apple iPhone 14 Pro 128GB, 6.1 inç Super Retina XDR Ekran, A16 Bionic Çip',
                'sku' => 'IPHONE14P-128-GRY',
                'barcode' => '194252917428',
                'price' => 49999.90,
                'cost' => 42000.00,
                'tax_rate' => 18,
                'stock_quantity' => 15,
                'min_stock_level' => 3,
                'category_name' => 'Akıllı Telefonlar',
                'supplier_name' => 'Smart Electronics Inc.',
                'featured' => true,
            ],
            // Bilgisayar > Dizüstü Bilgisayarlar
            [
                'name' => 'Lenovo ThinkPad X1 Carbon',
                'description' => 'Lenovo ThinkPad X1 Carbon, 14 inç FHD Ekran, Intel Core i7, 16GB RAM, 512GB SSD',
                'sku' => 'LNV-X1C-7I7-16-512',
                'barcode' => '192651071223',
                'price' => 38999.90,
                'cost' => 32000.00,
                'tax_rate' => 18,
                'stock_quantity' => 10,
                'min_stock_level' => 2,
                'category_name' => 'Dizüstü Bilgisayarlar',
                'supplier_name' => 'Global Supply Chain Co.',
                'featured' => true,
            ],
            [
                'name' => 'Apple MacBook Pro 14"',
                'description' => 'Apple MacBook Pro 14 inç, M2 Pro Çip, 16GB RAM, 512GB SSD',
                'sku' => 'MBPM2P-16-512',
                'barcode' => '194253302841',
                'price' => 59999.90,
                'cost' => 50000.00,
                'tax_rate' => 18,
                'stock_quantity' => 8,
                'min_stock_level' => 2,
                'category_name' => 'Dizüstü Bilgisayarlar',
                'supplier_name' => 'Smart Electronics Inc.',
                'featured' => true,
            ],
            // Bilgisayar > Monitörler
            [
                'name' => 'Dell UltraSharp 27" 4K',
                'description' => 'Dell UltraSharp 27 inç 4K USB-C Hub Monitör (U2723QE)',
                'sku' => 'DELL-U2723QE',
                'barcode' => '5397184732839',
                'price' => 14999.90,
                'cost' => 11000.00,
                'tax_rate' => 18,
                'stock_quantity' => 20,
                'min_stock_level' => 4,
                'category_name' => 'Monitörler',
                'supplier_name' => 'Global Supply Chain Co.',
                'featured' => false,
            ],
            // Ofis Malzemeleri > Yazıcı Sarf Malzemeleri
            [
                'name' => 'HP 305A Toner Seti',
                'description' => 'HP 305A Orijinal Siyah, Cam Göbeği, Macenta, Sarı LaserJet Toner Kartuşları Paketi',
                'sku' => 'HP-305A-SET',
                'barcode' => '887110049409',
                'price' => 6999.90,
                'cost' => 5500.00,
                'tax_rate' => 18,
                'stock_quantity' => 30,
                'min_stock_level' => 10,
                'category_name' => 'Yazıcı Sarf Malzemeleri',
                'supplier_name' => 'East Asia Trading Co.',
                'featured' => false,
            ],
            // Mobilya > Ofis Mobilyaları
            [
                'name' => 'Ergonomik Ofis Koltuğu',
                'description' => 'Yüksek Sırtlı Mesh Ergonomik Ofis Koltuğu, Ayarlanabilir Kol Dayamalı',
                'sku' => 'ERGO-CHR-PRO',
                'barcode' => '8692953672317',
                'price' => 3999.90,
                'cost' => 2800.00,
                'tax_rate' => 18,
                'stock_quantity' => 15,
                'min_stock_level' => 5,
                'category_name' => 'Ofis Mobilyaları',
                'supplier_name' => 'Anatolian Textiles A.Ş.',
                'featured' => false,
            ],
            // Beyaz Eşya > Buzdolapları
            [
                'name' => 'Arçelik 583 LT No Frost Buzdolabı',
                'description' => 'Arçelik 2191 NFIY 583 LT No Frost Buzdolabı, Inox',
                'sku' => 'ARC-2191NFIY',
                'barcode' => '8690842200304',
                'price' => 22999.90,
                'cost' => 18000.00,
                'tax_rate' => 18,
                'stock_quantity' => 12,
                'min_stock_level' => 3,
                'category_name' => 'Buzdolapları',
                'supplier_name' => 'Global Supply Chain Co.',
                'featured' => true,
            ],
            [
                'name' => 'HP ProBook 450 G8',
                'slug' => Str::slug('HP ProBook 450 G8'),
                'description' => 'Intel Core i5-1135G7, 8GB RAM, 256GB SSD, 15.6" FHD',
                'sku' => 'NB-HP-450G8',
                'barcode' => '1234567890123',
                'thumbnail' => null,
                'price' => 15999.99,
                'cost' => 13500.00,
                'tax_rate' => 18,
                'stock_quantity' => 25,
                'min_stock_level' => 5,
                'category_name' => 'Dizüstü Bilgisayarlar',
                'supplier_name' => 'Tech Components Ltd.',
                'featured' => true,
                'status' => true
            ],
            [
                'name' => 'Microsoft Office 365 Business',
                'slug' => Str::slug('Microsoft Office 365 Business'),
                'description' => '1 yıllık lisans, 5 kullanıcı, tüm Office uygulamaları',
                'sku' => 'SW-MS-O365B',
                'barcode' => '2345678901234',
                'thumbnail' => null,
                'price' => 1299.99,
                'cost' => 999.99,
                'tax_rate' => 18,
                'stock_quantity' => 100,
                'min_stock_level' => 20,
                'category_name' => 'Yazılım',
                'supplier_name' => 'Software Plus',
                'featured' => false,
                'status' => true
            ],
            [
                'name' => 'A4 Fotokopi Kağıdı (5 Paket)',
                'slug' => Str::slug('A4 Fotokopi Kağıdı (5 Paket)'),
                'description' => '80g/m², 500 yaprak, 5 paket',
                'sku' => 'ST-A4-5PK',
                'barcode' => '3456789012345',
                'thumbnail' => null,
                'price' => 449.99,
                'cost' => 350.00,
                'tax_rate' => 18,
                'stock_quantity' => 200,
                'min_stock_level' => 50,
                'category_name' => 'Ofis Malzemeleri',
                'supplier_name' => 'Office Solutions A.Ş.',
                'featured' => false,
                'status' => true
            ]
        ];

        foreach ($products as $product) {
            $category = Category::where('name', $product['category_name'])->first();
            $supplier = Supplier::where('name', $product['supplier_name'])->first();

            if ($category && $supplier) {
                Product::create([
                    'name' => $product['name'],
                    'slug' => $product['slug'],
                    'description' => $product['description'],
                    'sku' => $product['sku'],
                    'barcode' => $product['barcode'],
                    'price' => $product['price'],
                    'cost' => $product['cost'],
                    'tax_rate' => $product['tax_rate'],
                    'stock_quantity' => $product['stock_quantity'],
                    'min_stock_level' => $product['min_stock_level'],
                    'category_id' => $category->id,
                    'supplier_id' => $supplier->id,
                    'status' => $product['status'],
                    'featured' => $product['featured'],
                ]);
            }
        }

        // Ek ürünler için factory kullan
        // Not: Factory daha sonra eklenecek
        // Product::factory(20)->create();
    }
} 