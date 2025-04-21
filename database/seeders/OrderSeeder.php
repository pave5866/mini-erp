<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Örnek sipariş verileri
        $orders = [
            [
                'customer_email' => 'ahmet.yilmaz@example.com',
                'status' => Order::STATUS_COMPLETED,
                'shipping_address' => 'Atatürk Cad. No:123 Kadıköy, İstanbul',
                'shipping_method' => 'Standart Kargo',
                'payment_method' => 'Kredi Kartı',
                'payment_status' => 'paid',
                'notes' => 'Öğleden sonra teslimat tercih ediliyor.',
                'order_date' => now()->subDays(15),
                'items' => [
                    [
                        'product_sku' => 'SM-S23U-256-BLK',
                        'quantity' => 1,
                    ],
                    [
                        'product_sku' => 'HP-305A-SET',
                        'quantity' => 2,
                    ],
                ],
            ],
            [
                'customer_email' => 'info@abcteknoloji.com',
                'status' => Order::STATUS_COMPLETED,
                'shipping_address' => 'Levent Mah. No:123 Beşiktaş, İstanbul',
                'shipping_method' => 'Hızlı Kargo',
                'payment_method' => 'Banka Havalesi',
                'payment_status' => 'paid',
                'notes' => 'Fatura için vergi numarası eklenecek.',
                'order_date' => now()->subDays(10),
                'items' => [
                    [
                        'product_sku' => 'LNV-X1C-7I7-16-512',
                        'quantity' => 5,
                    ],
                    [
                        'product_sku' => 'DELL-U2723QE',
                        'quantity' => 5,
                    ],
                    [
                        'product_sku' => 'ERGO-CHR-PRO',
                        'quantity' => 10,
                    ],
                ],
            ],
            [
                'customer_email' => 'ayse.demir@example.com',
                'status' => Order::STATUS_PROCESSING,
                'shipping_address' => 'Bağdat Cad. No:456 Maltepe, İstanbul',
                'shipping_method' => 'Standart Kargo',
                'payment_method' => 'Kredi Kartı',
                'payment_status' => 'paid',
                'notes' => '',
                'order_date' => now()->subDays(2),
                'items' => [
                    [
                        'product_sku' => 'IPHONE14P-128-GRY',
                        'quantity' => 1,
                    ],
                ],
            ],
            [
                'customer_email' => 'info@xyzyazilim.com',
                'status' => Order::STATUS_PENDING,
                'shipping_address' => 'Esentepe Mah. No:456 Şişli, İstanbul',
                'shipping_method' => 'Hızlı Kargo',
                'payment_method' => 'Havale/EFT',
                'payment_status' => 'pending',
                'notes' => 'Ödeme onayından sonra kargoya verilecek',
                'order_date' => now()->subDay(),
                'items' => [
                    [
                        'product_sku' => 'MBPM2P-16-512',
                        'quantity' => 2,
                    ],
                    [
                        'product_sku' => 'HP-305A-SET',
                        'quantity' => 5,
                    ],
                ],
            ],
            [
                'customer_email' => 'mehmet.kaya@example.com',
                'status' => Order::STATUS_CANCELLED,
                'shipping_address' => 'Cumhuriyet Mah. No:789 Beylikdüzü, İstanbul',
                'shipping_method' => 'Standart Kargo',
                'payment_method' => 'Kapıda Ödeme',
                'payment_status' => 'refunded',
                'notes' => 'Müşteri siparişi iptal etti',
                'order_date' => now()->subDays(5),
                'items' => [
                    [
                        'product_sku' => 'ARC-2191NFIY',
                        'quantity' => 1,
                    ],
                ],
            ],
        ];

        // Siparişleri oluşturalım
        foreach ($orders as $orderData) {
            $customer = Customer::where('email', $orderData['customer_email'])->first();
            
            if ($customer) {
                // Sipariş ana verilerini oluştur
                $order = new Order();
                $order->order_number = 'ORD-' . strtoupper(substr(md5(uniqid()), 0, 8));
                $order->customer_id = $customer->id;
                $order->status = $orderData['status'];
                $order->shipping_address = $orderData['shipping_address'];
                $order->shipping_method = $orderData['shipping_method'];
                $order->payment_method = $orderData['payment_method'];
                $order->payment_status = $orderData['payment_status'];
                $order->notes = $orderData['notes'];
                $order->created_at = $orderData['order_date'];
                $order->updated_at = $orderData['order_date'];
                
                // Sipariş toplamlarını hesaplayalım
                $totalAmount = 0;
                $taxAmount = 0;
                
                // İlk önce siparişi kaydedelim
                $order->save();
                
                // Şimdi sipariş kalemlerini ekleyelim
                foreach ($orderData['items'] as $itemData) {
                    $product = Product::where('sku', $itemData['product_sku'])->first();
                    
                    if ($product) {
                        $quantity = $itemData['quantity'];
                        $unitPrice = $product->price;
                        $taxRate = $product->tax_rate;
                        
                        // Ara toplam ve vergi hesapları
                        $subtotal = $unitPrice * $quantity;
                        $itemTaxAmount = $subtotal * ($taxRate / 100);
                        
                        // Sipariş kalemi oluştur
                        $orderItem = new OrderItem();
                        $orderItem->order_id = $order->id;
                        $orderItem->product_id = $product->id;
                        $orderItem->product_name = $product->name;
                        $orderItem->quantity = $quantity;
                        $orderItem->unit_price = $unitPrice;
                        $orderItem->tax_rate = $taxRate;
                        $orderItem->tax_amount = $itemTaxAmount;
                        $orderItem->discount_amount = 0;
                        $orderItem->subtotal = $subtotal;
                        $orderItem->total = $subtotal + $itemTaxAmount;
                        $orderItem->save();
                        
                        // Sipariş toplamlarını güncelle
                        $totalAmount += $subtotal;
                        $taxAmount += $itemTaxAmount;
                    }
                }
                
                // Sipariş toplamlarını güncelle
                $order->total_amount = $totalAmount;
                $order->tax_amount = $taxAmount;
                $order->discount_amount = 0;
                $order->shipping_amount = $totalAmount > 5000 ? 0 : 49.90;
                $order->grand_total = $totalAmount + $taxAmount + $order->shipping_amount;
                $order->save();
            }
        }
    }
} 