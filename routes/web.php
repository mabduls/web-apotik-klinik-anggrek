<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserProductTransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardPageController::class, 'index'])
        ->middleware(['auth', 'verified', 'role:owner'])->name('dashboard');
        Route::resource('products', ProductController::class)->middleware('role:owner');
        Route::resource('categories', CategoryController::class)->middleware('role:owner');
        Route::resource('product_transactions', ProductTransactionController::class)->middleware('role:owner');

        Route::get('/reservations/rekap', [ReservationController::class, 'showRekap'])->name('reservations.rekap');
        Route::get('/reservations/rekap/{rekap}', [ReservationController::class, 'showRekapDetails'])->name('reservations.rekap.details');
        Route::put('/reservations/rekap/{rekap}', [ReservationController::class, 'updateRekap'])->name('reservations.rekap.update');

        Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::get('/reservations/{reservation}', [ReservationController::class, 'showDetails'])->name('reservations.show');
        Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    });

    Route::prefix('customers')->name('customers.')->middleware('role:customers')->group(function () {
        // Dashboard 
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard.page.index');
        Route::get('/doctor', [UserDashboardController::class, 'showDoctors'])->name('dashboard.page.doctors');
        Route::get('/cart', [CartController::class, 'cart'])->name('dashboard.page.cart');
        Route::get('/medicine', [UserDashboardController::class, 'showMedicines'])->name('dashboard.page.medicines');

        // Product Details 
        Route::get('/details/{product:slug}', [UserDashboardController::class, 'details'])->name('dashboard.page.details');

        // Reservation 
        Route::get('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
        Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
        Route::get('/reservation/details/{reservation}', [ReservationController::class, 'showDetails'])->name('reservation.details');
        Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.page'); 

        // Transaction 
        Route::get('/transaction/details/{productTransaction}', [UserProductTransactionController::class, 'details'])->name('transaction.details');
        Route::get('/transaction', [UserProductTransactionController::class, 'index'])->name('transaction.page'); 
        Route::post('/transaction', [UserProductTransactionController::class, 'store'])->name('transaction.store');

        // Cart Actions
        Route::post('/cart/{productId}', [CartController::class, 'store'])->name('dashboard.page.cart.store');
        Route::post('/cart/{cart}/update-quantity', [CartController::class, 'updateQuantity'])->name('dashboard.page.cart.update-quantity');
        Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('dashboard.page.cart.remove');
        Route::delete('/cart', [CartController::class, 'clear'])->name('dashboard.page.cart.clear');
    });
});

require __DIR__ . '/auth.php';
