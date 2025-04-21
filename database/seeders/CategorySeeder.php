<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainCategories = [
            [
                'name' => 'Elektronik',
                'subcategories' => [
                    'Bilgisayarlar',
                    'Telefonlar',
                    'Tabletler',
                    'Monitörler',
                    'Yazıcılar',
                    'Aksesuarlar'
                ]
            ],
            [
                'name' => 'Ofis Malzemeleri',
                'subcategories' => [
                    'Kırtasiye',
                    'Mobilya',
                    'Sarf Malzemeleri',
                    'Dosyalama',
                    'Sunum Ekipmanları'
                ]
            ],
            [
                'name' => 'Yazılım',
                'subcategories' => [
                    'İşletim Sistemleri',
                    'Ofis Yazılımları',
                    'Antivirüs',
                    'Tasarım Yazılımları',
                    'Muhasebe Yazılımları'
                ]
            ]
        ];

        foreach ($mainCategories as $mainCategory) {
            // Ana kategoriyi oluştur
            $parent = Category::create([
                'name' => $mainCategory['name'],
                'slug' => Str::slug($mainCategory['name']),
                'description' => $mainCategory['name'] . ' kategorisi',
                'status' => true
            ]);

            // Alt kategorileri oluştur
            foreach ($mainCategory['subcategories'] as $subcategory) {
                Category::create([
                    'name' => $subcategory,
                    'slug' => Str::slug($subcategory),
                    'description' => $subcategory . ' alt kategorisi',
                    'parent_id' => $parent->id,
                    'status' => true
                ]);
            }
        }
    }
} 