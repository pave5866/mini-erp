@extends('layouts.app')

@section('title', 'Müşteri Detayları')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Müşteri Bilgileri</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">{{ $customer->name }} müşterisinin detayları.</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('customers.edit', $customer->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Düzenle
            </a>
            <a href="{{ route('customers.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Müşteri Listesine Dön
            </a>
        </div>
    </div>
    <div class="border-t border-gray-200 dark:border-gray-700">
        <dl>
            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Müşteri Tipi</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $customer->customer_type == 'individual' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ $customer->customer_type == 'individual' ? 'Bireysel' : 'Kurumsal' }}
                    </span>
                </dd>
            </div>
            <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Ad Soyad / Şirket Adı</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2 flex items-center">
                    @if($customer->photo)
                        <img src="{{ asset('storage/' . $customer->photo) }}" alt="{{ $customer->name }}" class="h-10 w-10 rounded-full mr-3">
                    @else
                        <span class="h-10 w-10 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-600 mr-3">
                            <svg class="h-full w-full text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                    @endif
                    {{ $customer->name }}
                </dd>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">E-posta</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                    <a href="mailto:{{ $customer->email }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                        {{ $customer->email }}
                    </a>
                </dd>
            </div>
            <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Telefon</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                    <a href="tel:{{ $customer->phone }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                        {{ $customer->phone }}
                    </a>
                </dd>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ $customer->customer_type == 'individual' ? 'TC Kimlik No' : 'Vergi No' }}</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{ $customer->tax_id ?: 'Belirtilmemiş' }}</dd>
            </div>
            @if($customer->customer_type == 'corporate')
            <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Vergi Dairesi</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{ $customer->tax_office ?: 'Belirtilmemiş' }}</dd>
            </div>
            @endif
            <div class="bg-{{ $customer->customer_type == 'corporate' ? 'gray-50 dark:bg-gray-700' : 'white dark:bg-gray-800' }} px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Adres</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                    {{ $customer->address ?: 'Belirtilmemiş' }}
                    @if($customer->city || $customer->zip_code || $customer->country)
                    <br>
                    {{ $customer->city ?? '' }} 
                    {{ $customer->zip_code ? $customer->zip_code : '' }} 
                    {{ $customer->country ? config('countries.' . $customer->country, $customer->country) : '' }}
                    @endif
                </dd>
            </div>
            <div class="bg-{{ $customer->customer_type == 'corporate' ? 'white dark:bg-gray-800' : 'gray-50 dark:bg-gray-700' }} px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Müşteri Grubu</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                    @switch($customer->customer_group)
                        @case('standard')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                Standart
                            </span>
                            @break
                        @case('vip')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                                VIP
                            </span>
                            @break
                        @case('wholesale')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                Toptan
                            </span>
                            @break
                        @default
                            <span class="text-gray-500 dark:text-gray-400">Belirtilmemiş</span>
                    @endswitch
                </dd>
            </div>
            <div class="bg-{{ $customer->customer_type == 'corporate' ? 'gray-50 dark:bg-gray-700' : 'white dark:bg-gray-800' }} px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Durum</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $customer->status == 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                        {{ $customer->status == 'active' ? 'Aktif' : 'Pasif' }}
                    </span>
                </dd>
            </div>
            <div class="bg-{{ $customer->customer_type == 'corporate' ? 'white dark:bg-gray-800' : 'gray-50 dark:bg-gray-700' }} px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Notlar</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                    {{ $customer->notes ?: 'Not bulunmuyor' }}
                </dd>
            </div>
            <div class="bg-{{ $customer->customer_type == 'corporate' ? 'gray-50 dark:bg-gray-700' : 'white dark:bg-gray-800' }} px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Kayıt Tarihi</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                    {{ $customer->created_at->format('d.m.Y H:i') }}
                </dd>
            </div>
            <div class="bg-{{ $customer->customer_type == 'corporate' ? 'white dark:bg-gray-800' : 'gray-50 dark:bg-gray-700' }} px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Son Güncelleme</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                    {{ $customer->updated_at->format('d.m.Y H:i') }}
                </dd>
            </div>
        </dl>
    </div>
</div>

<!-- Müşteri İşlemleri -->
<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-6">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Müşteri İşlemleri</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Bu müşteri ile ilgili yapabileceğiniz işlemler.</p>
    </div>
    <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-5">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <a href="#" class="group block rounded-lg p-4 bg-white dark:bg-gray-700 ring-1 ring-gray-200 dark:ring-gray-600 hover:bg-blue-50 hover:ring-blue-500 dark:hover:bg-blue-900 dark:hover:ring-blue-400 transition-all duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-blue-700 dark:group-hover:text-blue-300">Faturalar</h4>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Müşteriye ait faturaları görüntüle</p>
                    </div>
                </div>
            </a>
            <a href="#" class="group block rounded-lg p-4 bg-white dark:bg-gray-700 ring-1 ring-gray-200 dark:ring-gray-600 hover:bg-blue-50 hover:ring-blue-500 dark:hover:bg-blue-900 dark:hover:ring-blue-400 transition-all duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-blue-700 dark:group-hover:text-blue-300">Siparişler</h4>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Müşterinin siparişlerini görüntüle</p>
                    </div>
                </div>
            </a>
            <a href="#" class="group block rounded-lg p-4 bg-white dark:bg-gray-700 ring-1 ring-gray-200 dark:ring-gray-600 hover:bg-blue-50 hover:ring-blue-500 dark:hover:bg-blue-900 dark:hover:ring-blue-400 transition-all duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-3 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-blue-700 dark:group-hover:text-blue-300">Ödemeler</h4>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Müşterinin ödeme geçmişini görüntüle</p>
                    </div>
                </div>
            </a>
            <a href="#" class="group block rounded-lg p-4 bg-white dark:bg-gray-700 ring-1 ring-gray-200 dark:ring-gray-600 hover:bg-blue-50 hover:ring-blue-500 dark:hover:bg-blue-900 dark:hover:ring-blue-400 transition-all duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-blue-700 dark:group-hover:text-blue-300">Randevular</h4>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Müşteri randevularını görüntüle</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection 