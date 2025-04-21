@extends('layouts.app')

@section('title', 'Ayarlar')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Genel Ayarlar</h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Uygulama genel ayarlarını yapılandırın.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="#" method="POST">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Şirket Adı</label>
                                <input type="text" name="company_name" id="company_name" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm" value="ABC Ticaret Ltd. Şti.">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">İletişim E-postası</label>
                                <input type="email" name="contact_email" id="contact_email" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm" value="info@abcticaret.com">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Para Birimi</label>
                                <select id="currency" name="currency" class="mt-1 block w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:text-gray-300">
                                    <option value="TRY" selected>Türk Lirası (₺)</option>
                                    <option value="USD">Amerikan Doları ($)</option>
                                    <option value="EUR">Euro (€)</option>
                                    <option value="GBP">İngiliz Sterlini (£)</option>
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="timezone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Saat Dilimi</label>
                                <select id="timezone" name="timezone" class="mt-1 block w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:text-gray-300">
                                    <option value="Europe/Istanbul" selected>İstanbul (UTC+3)</option>
                                    <option value="Europe/London">Londra (UTC+0/+1)</option>
                                    <option value="America/New_York">New York (UTC-5/-4)</option>
                                    <option value="Asia/Tokyo">Tokyo (UTC+9)</option>
                                </select>
                            </div>

                            <div class="col-span-6">
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adres</label>
                                <textarea id="address" name="address" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm">İstiklal Caddesi No:123 Beyoğlu İstanbul 34400</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Kaydet
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200 dark:border-gray-700"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Fatura Ayarları</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Fatura ve ödeme ayarlarını yapılandırın.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="tax_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vergi Numarası</label>
                                    <input type="text" name="tax_number" id="tax_number" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm" value="1234567890">
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="tax_office" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vergi Dairesi</label>
                                    <input type="text" name="tax_office" id="tax_office" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm" value="Beyoğlu">
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="vat_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Varsayılan KDV Oranı (%)</label>
                                    <input type="number" name="vat_rate" id="vat_rate" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm" value="18">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="payment_due_days" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ödeme Vadesi (Gün)</label>
                                    <input type="number" name="payment_due_days" id="payment_due_days" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm" value="30">
                                </div>

                                <div class="col-span-6">
                                    <label for="invoice_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Varsayılan Fatura Notu</label>
                                    <textarea id="invoice_notes" name="invoice_notes" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm">Ödemeleriniz için teşekkür ederiz. Sorularınız için lütfen bizimle iletişime geçin.</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Kaydet
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200 dark:border-gray-700"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Arayüz Ayarları</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Uygulama arayüz tercihlerinizi özelleştirin.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6">
                            <div class="space-y-6">
                                <fieldset>
                                    <legend class="text-base font-medium text-gray-900 dark:text-gray-100">Tema</legend>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-center">
                                            <input id="theme-light" name="theme" type="radio" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700">
                                            <label for="theme-light" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Açık Tema
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="theme-dark" name="theme" type="radio" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700" checked>
                                            <label for="theme-dark" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Koyu Tema
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="theme-system" name="theme" type="radio" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700">
                                            <label for="theme-system" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Sistem Teması (Otomatik)
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend class="text-base font-medium text-gray-900 dark:text-gray-100">Tablo Görünümü</legend>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-center">
                                            <input id="table-compact" name="table_view" type="radio" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700">
                                            <label for="table-compact" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Kompakt
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="table-default" name="table_view" type="radio" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700" checked>
                                            <label for="table-default" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Standart
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="table-comfortable" name="table_view" type="radio" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700">
                                            <label for="table-comfortable" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Geniş
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                
                                <div>
                                    <label for="items_per_page" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sayfa Başına Öğe Sayısı</label>
                                    <select id="items_per_page" name="items_per_page" class="mt-1 block w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:text-gray-300">
                                        <option value="10">10</option>
                                        <option value="25" selected>25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Kaydet
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 