<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Tedarikçi rotaları
    Route::prefix('suppliers')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('suppliers.index');
        Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
        Route::post('/', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::get('/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
        Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
        Route::put('/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
        Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
        Route::patch('/{supplier}/toggle-status', [SupplierController::class, 'toggleStatus'])->name('suppliers.toggle-status');
    });

    // Müşteri Rotaları
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
        
        Route::get('/create', function () {
            return view('customers.create');
        })->name('customers.create');
        
        Route::get('/{id}', function ($id) {
            return view('customers.show', ['id' => $id]);
        })->name('customers.show');
        
        Route::get('/{id}/edit', function ($id) {
            return view('customers.edit', ['id' => $id]);
        })->name('customers.edit');
        
        Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    });

    // Ürün/Stok Rotaları
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::patch('/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
        
        Route::get('/stock', function () {
            return view('products.stock.index');
        })->name('stock.index');
        
        Route::get('/stock/create', function () {
            return view('products.stock.create');
        })->name('stock.create');
    });

    // Satış Rotaları
    Route::prefix('sales')->group(function () {
        Route::get('/', function () {
            return view('sales.index');
        })->name('sales.index');
        
        Route::get('/create', function () {
            return view('sales.create');
        })->name('sales.create');
        
        Route::get('/{id}', function ($id) {
            return view('sales.show', ['id' => $id]);
        })->name('sales.show');
        
        Route::get('/invoices', function () {
            return view('sales.invoices');
        })->name('sales.invoices');
    });

    // Raporlar
    Route::prefix('reports')->group(function () {
        Route::get('/sales', function () {
            return view('reports.sales');
        })->name('reports.sales');
        
        Route::get('/stock', function () {
            return view('reports.stock');
        })->name('reports.stock');
        
        Route::get('/customers', function () {
            return view('reports.customers');
        })->name('reports.customers');
        
        Route::get('/financial', function () {
            return view('reports.financial');
        })->name('reports.financial');
    });
});

// Kullanıcı Yönetimi
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::put('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');

Route::get('/settings', function () {
    return view('settings');
})->name('settings')->middleware('auth');
