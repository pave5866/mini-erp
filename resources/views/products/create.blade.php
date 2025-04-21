@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Yeni Ürün Ekle
                    </h2>
                    <a href="{{ route('products.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                        </svg>
                        Listeye Dön
                    </a>
                </div>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Temel Bilgiler -->
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Temel Bilgiler</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ürün Adı <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Açıklama</label>
                                    <textarea name="description" id="description" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="sku" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SKU</label>
                                        <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('sku')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="barcode" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barkod</label>
                                        <input type="text" name="barcode" id="barcode" value="{{ old('barcode') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('barcode')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ürün Görseli</label>
                                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                                        class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-indigo-50 file:text-indigo-700
                                        dark:file:bg-indigo-900 dark:file:text-indigo-300
                                        hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800">
                                    @error('thumbnail')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Fiyat ve Stok Bilgileri -->
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Fiyat ve Stok Bilgileri</h3>
                            
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Satış Fiyatı <span class="text-red-500">*</span></label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price') }}" required
                                                class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white pr-12 focus:border-indigo-500 focus:ring-indigo-500">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                <span class="text-gray-500 dark:text-gray-400 sm:text-sm">₺</span>
                                            </div>
                                        </div>
                                        @error('price')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Maliyet <span class="text-red-500">*</span></label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <input type="number" name="cost" id="cost" step="0.01" min="0" value="{{ old('cost') }}" required
                                                class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white pr-12 focus:border-indigo-500 focus:ring-indigo-500">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                <span class="text-gray-500 dark:text-gray-400 sm:text-sm">₺</span>
                                            </div>
                                        </div>
                                        @error('cost')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="tax_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">KDV Oranı <span class="text-red-500">*</span></label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="number" name="tax_rate" id="tax_rate" min="0" max="100" value="{{ old('tax_rate', 18) }}" required
                                            class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white pr-12 focus:border-indigo-500 focus:ring-indigo-500">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-gray-500 dark:text-gray-400 sm:text-sm">%</span>
                                        </div>
                                    </div>
                                    @error('tax_rate')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok Miktarı <span class="text-red-500">*</span></label>
                                        <input type="number" name="stock_quantity" id="stock_quantity" min="0" value="{{ old('stock_quantity', 0) }}" required
                                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('stock_quantity')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="min_stock_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Minimum Stok <span class="text-red-500">*</span></label>
                                        <input type="number" name="min_stock_level" id="min_stock_level" min="0" value="{{ old('min_stock_level', 5) }}" required
                                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('min_stock_level')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kategori ve Tedarikçi -->
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Kategori ve Tedarikçi</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                    <select name="category_id" id="category_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Kategori Seçin</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="supplier_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tedarikçi</label>
                                    <select name="supplier_id" id="supplier_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Tedarikçi Seçin</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->company_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Durum ve Özellikler -->
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Durum ve Özellikler</h3>
                            
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="status" id="status" value="1" {{ old('status', true) ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900">
                                    <label for="status" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                        Aktif
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900">
                                    <label for="featured" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                        Öne Çıkan Ürün
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="reset" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Formu Temizle
                        </button>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ürünü Kaydet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Fiyat ve maliyet alanları için ondalık sayı formatı
    const priceInputs = document.querySelectorAll('input[type="number"][step="0.01"]');
    priceInputs.forEach(input => {
        input.addEventListener('change', function() {
            this.value = parseFloat(this.value).toFixed(2);
        });
    });
</script>
@endpush
@endsection 