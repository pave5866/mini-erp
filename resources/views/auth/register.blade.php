<!DOCTYPE html>
<html lang="tr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini ERP - Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .dark {
            background-color: #111827;
            color: #f3f4f6;
        }
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
        }
        .register-card {
            animation: fadeIn 0.6s ease-out;
        }
        .register-button {
            transition: all 0.3s ease;
        }
        .register-button:hover {
            transform: translateY(-2px);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="dark:bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full space-y-8 p-10 bg-white dark:bg-gray-800 rounded-xl shadow-lg register-card">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Mini ERP</h1>
            <div class="flex justify-center mb-8">
                <span class="p-3 rounded-full bg-blue-600 text-white">
                    <i class="fas fa-clipboard-list text-xl"></i>
                </span>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Yeni Hesap Oluştur</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Zaten hesabınız var mı? <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400">Giriş yapın</a></p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ad Soyad</label>
                <input id="name" name="name" type="text" autocomplete="name" required class="mt-1 appearance-none relative block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white dark:bg-gray-700 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm form-input" placeholder="Ad Soyad" value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-posta adresi</label>
                <input id="email" name="email" type="email" autocomplete="email" required class="mt-1 appearance-none relative block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white dark:bg-gray-700 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm form-input" placeholder="E-posta adresi" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Şifre</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required class="mt-1 appearance-none relative block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white dark:bg-gray-700 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm form-input" placeholder="Şifre">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Şifre Tekrar</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="mt-1 appearance-none relative block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white dark:bg-gray-700 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm form-input" placeholder="Şifre Tekrar">
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 register-button">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    Kayıt Ol
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <button type="button" id="toggleTheme" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 focus:outline-none">
                <i class="fas fa-sun mr-1"></i> Açık Tema
            </button>
        </div>
    </div>

    <script>
        document.getElementById('toggleTheme').addEventListener('click', function() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                this.innerHTML = '<i class="fas fa-moon mr-1"></i> Koyu Tema';
            } else {
                html.classList.add('dark');
                this.innerHTML = '<i class="fas fa-sun mr-1"></i> Açık Tema';
            }
        });
    </script>
</body>
</html> 