<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        
        if ($customers->isEmpty()) {
            $this->command->info('Fatura oluşturmak için önce müşteri kaydı olmalı.');
            return;
        }

        $invoiceStatuses = ['draft', 'issued', 'paid', 'overdue', 'cancelled'];
        $paymentMethods = ['cash', 'bank_transfer', 'credit_card', 'check'];
        
        // Sabit faturalar
        $invoices = [
            [
                'customer_id' => $customers->where('name', 'Ahmet Yılmaz')->first()?->id ?? $customers->first()->id,
                'invoice_number' => 'INV-2025-0001',
                'issue_date' => Carbon::now()->subDays(15),
                'due_date' => Carbon::now()->subDays(15)->addDays(30),
                'total_amount' => 2499.90,
                'tax_amount' => 449.98,
                'discount_amount' => 0,
                'grand_total' => 2949.88,
                'status' => 'paid',
                'payment_method' => 'credit_card',
                'payment_status' => 'paid',
                'notes' => 'Ödeme zamanında yapıldı',
            ],
            [
                'customer_id' => $customers->where('name', 'Ayşe Demir')->first()?->id ?? $customers->random()->id,
                'invoice_number' => 'INV-2025-0002',
                'issue_date' => Carbon::now()->subDays(10),
                'due_date' => Carbon::now()->subDays(10)->addDays(30),
                'total_amount' => 4299.50,
                'tax_amount' => 773.91,
                'discount_amount' => 200,
                'grand_total' => 4873.41,
                'status' => 'paid',
                'payment_method' => 'bank_transfer',
                'payment_status' => 'partial',
                'notes' => 'Kısmi ödeme yapıldı',
            ],
            [
                'customer_id' => $customers->where('name', 'XYZ Yazılım A.Ş.')->first()?->id ?? $customers->random()->id,
                'invoice_number' => 'INV-2025-0003',
                'issue_date' => Carbon::now()->subDays(5),
                'due_date' => Carbon::now()->subDays(5)->addDays(45),
                'total_amount' => 15750.00,
                'tax_amount' => 2835.00,
                'discount_amount' => 750,
                'grand_total' => 17835.00,
                'status' => 'issued',
                'payment_method' => 'bank_transfer',
                'payment_status' => 'unpaid',
                'notes' => 'Kurumsal müşteri 45 gün vade',
            ],
            [
                'customer_id' => $customers->where('name', 'ABC Teknoloji Ltd. Şti.')->first()?->id ?? $customers->random()->id,
                'invoice_number' => 'INV-2025-0004',
                'issue_date' => Carbon::now()->subDays(45),
                'due_date' => Carbon::now()->subDays(15),
                'total_amount' => 8750.00,
                'tax_amount' => 1575.00,
                'discount_amount' => 0,
                'grand_total' => 10325.00,
                'status' => 'overdue',
                'payment_method' => 'check',
                'payment_status' => 'unpaid',
                'notes' => 'Ödeme gecikti, hatırlatma yapıldı',
            ],
            [
                'customer_id' => $customers->where('name', 'Mehmet Kaya')->first()?->id ?? $customers->random()->id,
                'invoice_number' => 'INV-2025-0005',
                'issue_date' => Carbon::now()->subDays(2),
                'due_date' => Carbon::now()->addDays(28),
                'total_amount' => 1299.90,
                'tax_amount' => 233.98,
                'discount_amount' => 100,
                'grand_total' => 1433.88,
                'status' => 'draft',
                'payment_method' => null,
                'payment_status' => 'unpaid',
                'notes' => 'Taslak fatura',
            ],
            [
                'customer_id' => $customers->where('name', 'Mega Market Zinciri')->first()?->id ?? $customers->random()->id,
                'invoice_number' => 'INV-2025-0006',
                'issue_date' => Carbon::now()->subDays(30),
                'due_date' => Carbon::now(),
                'total_amount' => 22500.00,
                'tax_amount' => 4050.00,
                'discount_amount' => 1500,
                'grand_total' => 25050.00,
                'status' => 'paid',
                'payment_method' => 'bank_transfer',
                'payment_status' => 'paid',
                'notes' => 'Toplu sipariş',
            ],
        ];

        foreach ($invoices as $invoice) {
            Invoice::create($invoice);
        }

        // Rastgele faturalar
        foreach (range(1, 14) as $index) {
            $customer = $customers->random();
            $invoiceDate = Carbon::now()->subDays(rand(1, 60));
            $dueDate = (clone $invoiceDate)->addDays(rand(15, 45));
            $totalAmount = rand(500, 25000) / 10 * 10;
            $taxAmount = $totalAmount * 0.18;
            $discountAmount = rand(0, 10) > 7 ? rand(100, 1000) : 0;
            $grandTotal = $totalAmount + $taxAmount - $discountAmount;
            $status = $invoiceStatuses[array_rand($invoiceStatuses)];
            
            $paymentStatus = 'unpaid';
            if ($status === 'paid') {
                $paymentStatus = 'paid';
            } elseif ($status === 'overdue') {
                $paymentStatus = 'overdue';
            }
            
            Invoice::create([
                'customer_id' => $customer->id,
                'invoice_number' => 'INV-2025-' . str_pad($index + 7, 4, '0', STR_PAD_LEFT),
                'issue_date' => $invoiceDate,
                'due_date' => $dueDate,
                'total_amount' => $totalAmount,
                'tax_amount' => $taxAmount,
                'discount_amount' => $discountAmount,
                'grand_total' => $grandTotal,
                'status' => $status,
                'payment_method' => in_array($status, ['paid']) ? $paymentMethods[array_rand($paymentMethods)] : null,
                'payment_status' => $paymentStatus,
                'notes' => $status === 'overdue' ? 'Ödeme gecikti' : ($status === 'paid' ? 'Ödeme tamamlandı' : 'Standart fatura'),
            ]);
        }
    }
}
