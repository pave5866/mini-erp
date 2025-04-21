@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profil Bilgileri</h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Hesap bilgilerinizi ve e-posta adresinizi güncelleyin.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="#" method="POST">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ad Soyad</label>
                                <input type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm" value="Ahmet Yılmaz">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-posta adresi</label>
                                <input type="email" name="email" id="email" autocomplete="email" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm" value="ahmet.yilmaz@example.com">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fotoğraf</label>
                                <div class="mt-2 flex items-center">
                                    <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Profil Fotoğrafı" class="h-full w-full object-cover">
                                    </span>
                                    <button type="button" class="ml-5 bg-white dark:bg-gray-700 py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Değiştir
                                    </button>
                                </div>
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
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Şifreyi Güncelle</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Hesabınızın güvenliğini sağlamak için güçlü bir şifre kullanın.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mevcut Şifre</label>
                                    <input type="password" name="current_password" id="current_password" autocomplete="current-password" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm">
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Yeni Şifre</label>
                                    <input type="password" name="new_password" id="new_password" autocomplete="new-password" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm">
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Yeni Şifre Tekrar</label>
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" autocomplete="new-password" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-500 rounded-md shadow-sm">
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Şifreyi Güncelle
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
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Bildirim Ayarları</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Hangi bildirileri almak istediğinizi seçin.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6">
                            <fieldset>
                                <legend class="text-base font-medium text-gray-900 dark:text-gray-100">E-posta bildirimleri</legend>
                                <div class="mt-4 space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="notifications_new_order" name="notifications_new_order" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded" checked>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="notifications_new_order" class="font-medium text-gray-700 dark:text-gray-300">Yeni Sipariş</label>
                                            <p class="text-gray-500 dark:text-gray-400">Yeni bir sipariş alındığında bildirim al.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="notifications_low_stock" name="notifications_low_stock" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded" checked>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="notifications_low_stock" class="font-medium text-gray-700 dark:text-gray-300">Düşük Stok Uyarısı</label>
                                            <p class="text-gray-500 dark:text-gray-400">Bir ürün stok eşiğinin altına düştüğünde bildirim al.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="notifications_reports" name="notifications_reports" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="notifications_reports" class="font-medium text-gray-700 dark:text-gray-300">Haftalık Rapor</label>
                                            <p class="text-gray-500 dark:text-gray-400">Haftalık satış ve stok raporları için bildirim al.</p>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
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