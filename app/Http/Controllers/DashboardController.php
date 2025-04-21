<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // İstatistikler
            $stats = [
                'customer_count' => Customer::count(),
                'product_count' => Product::count(),
                'supplier_count' => Supplier::count(),
                'invoice_count' => Invoice::count(),
                'monthly_revenue' => Invoice::where('status', 'paid')
                    ->whereMonth('issue_date', now()->month)
                    ->sum('total_amount'),
                'recent_invoices' => Invoice::with('customer')
                    ->orderBy('issue_date', 'desc')
                    ->take(5)
                    ->get(),
                'low_stock_products' => Product::whereRaw('stock_quantity <= min_stock_level')
                    ->orderBy('stock_quantity')
                    ->take(5)
                    ->get(),
            ];

            return view('dashboard', compact('stats'));
        } catch (\Exception $e) {
            \Log::error('Dashboard yüklenirken hata: ' . $e->getMessage());
            return view('dashboard')->with('error', 'Veriler yüklenirken bir hata oluştu');
        }
    }
} 