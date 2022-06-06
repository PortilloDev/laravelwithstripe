<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  [BookController::class, 'index'])->name('bookstore');
Route::get('/cart/{id}',  [PaymentController::class, 'show'])->middleware('auth')->name('purchase');
Route::post('/payments/pay',  [PaymentController::class, 'pay'])->middleware('auth')->name('pay');
Route::get('/payments/approval',  [PaymentController::class, 'approval'])->middleware('auth')->name('approval');
Route::get('/payments/cancelled',  [PaymentController::class, 'cancelled'])->middleware('auth')->name('cancelled');

Route::prefix('subscribe')->middleware('auth')->name('subscribe.')
->group(function(){
    Route::get('/', [SubscriptionController::class, 'show'])->name('plans');
    Route::post('/', [SubscriptionController::class, 'store'])->name('store');
    Route::post('/approval', [SubscriptionController::class, 'approval'])->name('approval');
    Route::post('/cancelled', [SubscriptionController::class, 'cancelled'])->name('cancelled');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
