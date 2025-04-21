@extends('layouts.app')

@section('title', 'Yeni Müşteri Ekle')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Yeni Müşteri Ekle</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Sisteme yeni bir müşteri bilgisi ekleyin.</p>
    </div>
    <div>
        <a href="{{ route('customers.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
            </svg>
            Müşterilere Dön
        </a>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="border-b border-gray-200 dark:border-gray-700 px-4 py-5 sm:px-6">
            <div class="grid grid-cols-6 gap-6">
                <!-- Müşteri Tipi -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="customer_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Müşteri Tipi</label>
                    <select id="customer_type" name="customer_type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" required>
                        <option value="individual" {{ old('customer_type') == 'individual' ? 'selected' : '' }}>Bireysel</option>
                        <option value="corporate" {{ old('customer_type') == 'corporate' ? 'selected' : '' }}>Kurumsal</option>
                    </select>
                    @error('customer_type')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Müşteri Grubu -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="customer_group" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Müşteri Grubu</label>
                    <select id="customer_group" name="customer_group" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" required>
                        <option value="standard" {{ old('customer_group') == 'standard' ? 'selected' : '' }}>Standart</option>
                        <option value="vip" {{ old('customer_group') == 'vip' ? 'selected' : '' }}>VIP</option>
                        <option value="wholesale" {{ old('customer_group') == 'wholesale' ? 'selected' : '' }}>Toptan</option>
                    </select>
                    @error('customer_group')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- İsim / Şirket Adı -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <span id="name_label">İsim</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Vergi No / TC Kimlik No -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="tax_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <span id="tax_id_label">TC Kimlik No</span>
                    </label>
                    <input type="text" name="tax_id" id="tax_id" value="{{ old('tax_id') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                    @error('tax_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- E-posta -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-posta Adresi</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Telefon -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telefon</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md" required>
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Adres -->
                <div class="col-span-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adres</label>
                    <textarea name="address" id="address" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Şehir -->
                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Şehir</label>
                    <input type="text" name="city" id="city" value="{{ old('city') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                    @error('city')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Posta Kodu -->
                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <label for="postal_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Posta Kodu</label>
                    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                    @error('postal_code')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ülke -->
                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ülke</label>
                    <select id="country" name="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="TR" selected>Türkiye</option>
                        @foreach(config('countries') as $code => $name)
                            <option value="{{ $code }}" {{ old('country') == $code ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('country')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fotoğraf -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fotoğraf</label>
                    <div class="mt-1 flex items-center">
                        <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                            <svg class="h-full w-full text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                        <input type="file" name="photo" id="photo" class="ml-5 bg-white dark:bg-gray-700 py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    </div>
                    @error('photo')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Durum -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Durum</label>
                    <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Pasif</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notlar -->
                <div class="col-span-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notlar</label>
                    <textarea name="notes" id="notes" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                Müşteri Kaydet
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const customerTypeSelect = document.getElementById('customer_type');
        const nameLabel = document.getElementById('name_label');
        const taxIdLabel = document.getElementById('tax_id_label');
        
        function updateLabels() {
            if (customerTypeSelect.value === 'individual') {
                nameLabel.textContent = 'İsim';
                taxIdLabel.textContent = 'TC Kimlik No';
            } else {
                nameLabel.textContent = 'Şirket Adı';
                taxIdLabel.textContent = 'Vergi No';
            }
        }
        
        // Sayfa yüklendiğinde etiketleri güncelle
        updateLabels();
        
        // Müşteri tipi değiştiğinde etiketleri güncelle
        customerTypeSelect.addEventListener('change', updateLabels);
    });
</script>
@endpush
@endsection 