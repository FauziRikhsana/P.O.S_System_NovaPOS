<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\KasirDashboardController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/admin-dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');

});

/*
|--------------------------------------------------------------------------
| KASIR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:kasir'])->group(function () {

    Route::get('/kasir/dashboard', [KasirDashboardController::class, 'index'])
        ->name('kasir.dashboard');

    Route::get('/sales/history', [SaleController::class, 'history'])->name('sales.history');
    Route::post('/sales/scan', [SaleController::class, 'scan'])->name('sales.scan');
    Route::resource('sales', SaleController::class)->only(['index', 'store', 'show']);

});

/*
|--------------------------------------------------------------------------
| PROFILE (ADMIN & KASIR)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';