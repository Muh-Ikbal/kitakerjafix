<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// home
Route::get('/', [HomeController::class, 'index']);

//  layanan
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');

// home after login
Route::get('home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('my-account', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Order

Route::middleware('auth')->group(function () {
    Route::post('/order/by-name/{name}', [OrderController::class, 'order'])->name('order');
    Route::post('/order', [OrderController::class, 'create'])->name('order.create');
    Route::get('/my-order', [OrderController::class, 'myorder'])->name('order.myorder');
    Route::get('/my-order/orderdetail', [OrderController::class, 'detailOrder'])->name('myorder.detailorder');
});

Route::middleware('auth')->group(function () {
    // Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('payment', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('payment/verify', [PaymentController::class, 'handleNotification'])->name('payment.notification');
});


require __DIR__ . '/auth.php';
