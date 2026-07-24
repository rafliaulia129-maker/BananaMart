<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::get('/buy/{product}', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/buy/{product}', [TransactionController::class, 'storeWeb'])->name('transactions.store');

    Route::get('/transactions', [TransactionController::class, 'history'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'showWeb'])->name('transactions.show');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/admin/transactions', [AdminTransactionController::class, 'index'])
        ->name('admin.transactions.index');

    Route::patch('/admin/transactions/{transaction}/status', [AdminTransactionController::class, 'updateStatus'])
        ->name('admin.transactions.status');

    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])
        ->name('reports.export.excel');
    
    Route::get('/transactions/export/pdf', [TransactionController::class, 'exportPdf'])
    ->name('transactions.export.pdf');    
});

/*
|--------------------------------------------------------------------------
| Route dinamis taruh PALING BAWAH
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
});

require __DIR__ . '/auth.php';