@extends('layouts.app')

@section('title', 'Müşteri Düzenle')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Müşteri Düzenle</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Müşteri bilgilerini güncelleyin.</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('customers.show', $customer->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Görüntüle
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
        <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="space-y-8 divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            @method('PUT')
            <div class="space-y-8 divide-y divide-gray-200 dark:divide-gray-700 sm:space-y-5">
                <!-- Müşteri Temel Bilgileri -->
                <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Temel Bilgiler</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Müşteri temel bilgilerini güncelleyin.</p>
                    </div>
                    <div class="space-y-6 sm:space-y-5">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="customer_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Müşteri Tipi <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="flex items-center space-x-6">
                                    <div class="flex items-center">
                                        <input id="customer_type_individual" name="customer_type" type="radio" value="individual" {{ $customer->customer_type == 'individual' ? 'checked' : '' }} class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                        <label for="customer_type_individual" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Bireysel
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="customer_type_corporate" name="customer_type" type="radio" value="corporate" {{ $customer->customer_type == 'corporate' ? 'checked' : '' }} class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                        <label for="customer_type_corporate" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Kurumsal
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Ad Soyad / Şirket Adı <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input type="text" name="name" id="name" value="{{ $customer->name }}" autocomplete="name" required class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                E-posta <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input type="email" name="email" id="email" value="{{ $customer->email }}" autocomplete="email" required class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Telefon <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input type="tel" name="phone" id="phone" value="{{ $customer->phone }}" autocomplete="tel" required class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="tax_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Vergi No / TC Kimlik No
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input type="text" name="tax_id" id="tax_id" value="{{ $customer->tax_id }}" class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="tax_office" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Vergi Dairesi
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input type="text" name="tax_office" id="tax_office" value="{{ $customer->tax_office }}" class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Adres Bilgileri -->
                <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Adres Bilgileri</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Müşteri adres bilgilerini güncelleyin.</p>
                    </div>
                    <div class="space-y-6 sm:space-y-5">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Adres
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <textarea id="address" name="address" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">{{ $customer->address }}</textarea>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Şehir
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input type="text" name="city" id="city" value="{{ $customer->city }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="zip_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Posta Kodu
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input type="text" name="zip_code" id="zip_code" value="{{ $customer->zip_code }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Ülke
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <select id="country" name="country" class="max-w-lg block focus:ring-blue-500 focus:border-blue-500 w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">
                                    <option value="TR" {{ $customer->country == 'TR' ? 'selected' : '' }}>Türkiye</option>
                                    <option value="US" {{ $customer->country == 'US' ? 'selected' : '' }}>Amerika Birleşik Devletleri</option>
                                    <option value="GB" {{ $customer->country == 'GB' ? 'selected' : '' }}>Birleşik Krallık</option>
                                    <option value="DE" {{ $customer->country == 'DE' ? 'selected' : '' }}>Almanya</option>
                                    <option value="FR" {{ $customer->country == 'FR' ? 'selected' : '' }}>Fransa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ek Bilgiler -->
                <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Ek Bilgiler</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Müşteri ile ilgili ek bilgiler.</p>
                    </div>
                    <div class="space-y-6 sm:space-y-5">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="customer_group" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Müşteri Grubu
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <select id="customer_group" name="customer_group" class="max-w-lg block focus:ring-blue-500 focus:border-blue-500 w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">
                                    <option value="" {{ $customer->customer_group == '' ? 'selected' : '' }}>Seçiniz</option>
                                    <option value="standard" {{ $customer->customer_group == 'standard' ? 'selected' : '' }}>Standart</option>
                                    <option value="vip" {{ $customer->customer_group == 'vip' ? 'selected' : '' }}>VIP</option>
                                    <option value="wholesale" {{ $customer->customer_group == 'wholesale' ? 'selected' : '' }}>Toptan</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Notlar
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <textarea id="notes" name="notes" rows="4" class="max-w-lg shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">{{ $customer->notes }}</textarea>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Müşteri hakkında diğer personelin bilmesi gereken özel notlar.</p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Fotoğraf
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="flex items-center">
                                    <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                                        @if($customer->photo)
                                            <img src="{{ asset('storage/' . $customer->photo) }}" alt="{{ $customer->name }}" class="h-full w-full object-cover">
                                        @else
                                            <svg class="h-full w-full text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        @endif
                                    </span>
                                    <div class="ml-5 flex">
                                        <div class="relative bg-white dark:bg-gray-700 py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm flex items-center cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <label for="file-upload" class="relative text-sm font-medium text-gray-700 dark:text-gray-300 pointer-events-none">
                                                <span>Fotoğraf Değiştir</span>
                                                <span class="sr-only"> dosyası</span>
                                            </label>
                                            <input id="file-upload" name="file-upload" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md">
                                        </div>
                                        @if($customer->photo)
                                            <button type="button" class="ml-3 bg-white dark:bg-gray-700 py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                Fotoğrafı Kaldır
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:sm:border-gray-700 sm:pt-5">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sm:mt-px sm:pt-2">
                                Durum
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <select id="status" name="status" class="max-w-lg block focus:ring-blue-500 focus:border-blue-500 w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md">
                                    <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ $customer->status == 'inactive' ? 'selected' : '' }}>Pasif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <button type="button" class="bg-white dark:bg-gray-700 py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        İptal
                    </button>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Güncelle
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Müşteri tipine göre form alanlarını göster/gizle
    document.addEventListener('DOMContentLoaded', function() {
        const individualRadio = document.getElementById('customer_type_individual');
        const corporateRadio = document.getElementById('customer_type_corporate');
        const taxOfficeField = document.getElementById('tax_office').closest('.sm\\:grid');
        
        function toggleFields() {
            if (corporateRadio.checked) {
                taxOfficeField.classList.remove('hidden');
                document.querySelector('label[for="tax_id"]').textContent = 'Vergi No';
                document.querySelector('label[for="name"]').textContent = 'Şirket Adı';
            } else {
                taxOfficeField.classList.add('hidden');
                document.querySelector('label[for="tax_id"]').textContent = 'TC Kimlik No';
                document.querySelector('label[for="name"]').textContent = 'Ad Soyad';
            }
        }
        
        individualRadio.addEventListener('change', toggleFields);
        corporateRadio.addEventListener('change', toggleFields);
        
        // İlk yükleme
        toggleFields();
    });
</script>
@endsection 