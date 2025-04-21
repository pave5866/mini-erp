@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <!-- Toplam Müşteri Kartı -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                            Toplam Müşteri
                        </dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ $stats['customer_count'] }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('customers.index') }}" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">
                    Tümünü görüntüle
                </a>
            </div>
        </div>
    </div>

    <!-- Ürün Sayısı Kartı -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                            Toplam Ürün
                        </dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ $stats['product_count'] }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('products.index') }}" class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                    Tümünü görüntüle
                </a>
            </div>
        </div>
    </div>

    <!-- Tedarikçi Sayısı Kartı -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                            Tedarikçiler
                        </dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ $stats['supplier_count'] }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('suppliers.index') }}" class="font-medium text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300">
                    Tümünü görüntüle
                </a>
            </div>
        </div>
    </div>

    <!-- Gelir Kartı -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                            Aylık Gelir
                        </dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                ₺{{ number_format($stats['monthly_revenue'], 2) }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('reports.financial') }}" class="font-medium text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                    Raporlar
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Son Faturalar -->
<div class="mt-8">
    <h2 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">Son Faturalar</h2>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-700 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Fatura No
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Müşteri
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tutar
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Durum
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tarih
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Görüntüle</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($stats['recent_invoices'] as $invoice)
                            <tr class="transition-all hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $invoice->invoice_number }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <span class="h-10 w-10 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                                                <svg class="h-full w-full text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $invoice->customer?->name ?? 'Silinmiş Müşteri' }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $invoice->customer?->email ?? 'Müşteri bilgisi yok' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">₺{{ number_format($invoice->total_amount, 2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClass = match($invoice->status) {
                                            'paid' => 'bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100',
                                            'draft' => 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100',
                                            'pending' => 'bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-100',
                                            'overdue' => 'bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-100',
                                            'cancelled' => 'bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-100',
                                            default => 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100',
                                        };
                                        
                                        $statusText = match($invoice->status) {
                                            'paid' => 'Ödendi',
                                            'draft' => 'Taslak',
                                            'pending' => 'Beklemede',
                                            'overdue' => 'Gecikmiş',
                                            'cancelled' => 'İptal',
                                            default => ucfirst($invoice->status),
                                        };
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $invoice->issue_date->format('d F Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Görüntüle</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center">
                                    <div class="text-gray-500 dark:text-gray-400">Henüz fatura kaydı yok</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Düşük Stok Uyarıları -->
<div class="mt-8">
    <h2 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">Düşük Stok Uyarıları</h2>
    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($stats['low_stock_products'] as $product)
            <li>
                <div class="px-4 py-4 sm:px-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 bg-gray-100 dark:bg-gray-700 rounded-md flex items-center justify-center text-gray-500 dark:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <span>SKU: {{ $product->sku }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="text-sm font-medium mr-4">
                            <span class="text-gray-900 dark:text-white">Stok: </span>
                            <span class="font-bold text-red-600 dark:text-red-400">{{ $product->stock_quantity }}</span>
                            <span class="text-gray-500 dark:text-gray-400">/ {{ $product->min_stock_level }}</span>
                        </div>
                        <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 text-sm font-medium">
                            Stok Ekle
                        </a>
                    </div>
                </div>
            </li>
            @empty
            <li>
                <div class="px-4 py-4 sm:px-6 text-center">
                    <div class="text-gray-500 dark:text-gray-400">Düşük stok uyarısı yok</div>
                </div>
            </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection 