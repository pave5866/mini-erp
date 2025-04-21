@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Tedarikçi Detayı: {{ $supplier->name }}
            </h1>
            <div class="flex space-x-3">
                <a href="{{ route('suppliers.edit', $supplier) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Düzenle
                </a>
                <a href="{{ route('suppliers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Listeye Dön
                </a>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Temel Bilgiler -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700">
                        <h3 class="text-md font-medium text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Firma Bilgileri
                        </h3>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="grid grid-cols-1 gap-2">
                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Firma Adı:</span>
                                <span class="ml-2 font-medium text-gray-900 dark:text-white">{{ $supplier->name }}</span>
                            </div>
                            
                            @if($supplier->tax_id)
                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Vergi Numarası:</span>
                                <span class="ml-2 font-medium text-gray-900 dark:text-white">{{ $supplier->tax_id }}</span>
                            </div>
                            @endif
                            
                            @if($supplier->payment_terms)
                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Ödeme Koşulları:</span>
                                <span class="ml-2 font-medium text-gray-900 dark:text-white">
                                    @switch($supplier->payment_terms)
                                        @case('peşin')
                                            Peşin
                                            @break
                                        @case('7_gün')
                                            7 Gün
                                            @break
                                        @case('15_gün')
                                            15 Gün
                                            @break
                                        @case('30_gün')
                                            30 Gün
                                            @break
                                        @case('45_gün')
                                            45 Gün
                                            @break
                                        @case('60_gün')
                                            60 Gün
                                            @break
                                        @default
                                            {{ $supplier->payment_terms }}
                                    @endswitch
                                </span>
                            </div>
                            @endif

                            @if($supplier->website)
                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Web Sitesi:</span>
                                <a href="{{ $supplier->website }}" target="_blank" class="ml-2 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    {{ $supplier->website }}
                                    <svg class="inline-block w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                </a>
                            </div>
                            @endif

                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Durum:</span>
                                <span class="ml-2">
                                    @if($supplier->status)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Aktif
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        Pasif
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- İletişim Bilgileri -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700">
                        <h3 class="text-md font-medium text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            İletişim Bilgileri
                        </h3>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="grid grid-cols-1 gap-2">
                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Yetkili Kişi:</span>
                                <span class="ml-2 font-medium text-gray-900 dark:text-white">{{ $supplier->contact_person }}</span>
                            </div>
                            
                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">E-posta:</span>
                                <a href="mailto:{{ $supplier->email }}" class="ml-2 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    {{ $supplier->email }}
                                </a>
                            </div>
                            
                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Telefon:</span>
                                <a href="tel:{{ $supplier->phone }}" class="ml-2 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    {{ $supplier->phone }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Adres Bilgileri -->
                @if($supplier->address || $supplier->city || $supplier->country)
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700">
                        <h3 class="text-md font-medium text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Adres Bilgileri
                        </h3>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="grid grid-cols-1 gap-2">
                            @if($supplier->address)
                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Adres:</span>
                                <div class="mt-1 text-gray-900 dark:text-white whitespace-pre-line">{{ $supplier->address }}</div>
                            </div>
                            @endif
                            
                            @if($supplier->city || $supplier->country)
                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Konum:</span>
                                <span class="ml-2 font-medium text-gray-900 dark:text-white">
                                    @if($supplier->city){{ $supplier->city }}@endif
                                    @if($supplier->city && $supplier->country), @endif
                                    @if($supplier->country){{ $supplier->country }}@endif
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Notlar -->
                @if($supplier->notes)
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700">
                        <h3 class="text-md font-medium text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Notlar
                        </h3>
                    </div>
                    <div class="p-4">
                        <div class="text-sm text-gray-900 dark:text-white whitespace-pre-line">{{ $supplier->notes }}</div>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Kayıt Bilgileri -->
            <div class="mt-6 text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 pt-4">
                <div class="flex flex-wrap gap-x-6 gap-y-2">
                    <div>
                        <span class="font-medium">Kayıt Tarihi:</span>
                        <span>{{ $supplier->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Son Güncelleme:</span>
                        <span>{{ $supplier->updated_at->format('d.m.Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 