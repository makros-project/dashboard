<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KontrolProduksiController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/produk', function () {
//     return view('produk.produk');
// })->middleware(['auth', 'verified'])->name('produk');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //menampilkan produk di dashboard
    Route::resource('home', HomeController::class);

    Route::resource('produk', ProdukController::class);
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    Route::resource('kontrolProduksi', KontrolProduksiController::class);
    Route::get('/kontrolProduksi/create', [KontrolProduksiController::class, 'create'])->name('kontrolProduksi.create');
    Route::post('/kontrolProduksi', [KontrolProduksiController::class, 'store'])->name('kontrolProduksi.store');
    Route::get('/kontrolProduksi/{id}/edit', [KontrolProduksiController::class, 'edit'])->name('kontrolProduksi.edit');
    Route::put('/kontrolProduksi/{id}', [KontrolProduksiController::class, 'update'])->name('kontrolProduksi.update');
    Route::delete('/kontrolProduksi/{id}', [KontrolProduksiController::class, 'destroy'])->name('kontrolProduksi.destroy');

    Route::resource('sales', SalesController::class);
    Route::get('/sales/{no_inv}/show', [SalesController::class, 'show'])->name('sales.show');
    Route::put('/sales/{no_inv}', [SalesController::class, 'update'])->name('sales.update');

    Route::get('download', [SalesController::class, 'download'])->name('download.index');
    Route::get('/download/index', [SalesController::class, 'printPDF'])->name('sales.print');
    Route::get('/download/index', [SalesController::class, 'print'])->name('sales.print');
    
    // Route::get('/download', function () {
    //     return view('download.index');
    // });
        
        
    // Route::get('/sales/pdf', [SalesController::class, 'printPDF'])->name('sales.printPDF');


});

require __DIR__.'/auth.php';
