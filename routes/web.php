<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


use App\Http\Controllers\EventPublicController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SouvenirOrderController;


// รายการอีเวนต์ (อนุมัติแล้ว — ในที่นี้ถือว่าอยู่ในตาราง events แล้ว)
Route::get('/events', [EventPublicController::class,'index'])->name('home');
Route::get('/events/{id}', [EventPublicController::class,'show'])->name('events.show');

// ต้องล็อกอินก่อนจอง
Route::middleware(['auth','verified'])->group(function () {
    // จองตั๋ว
    Route::post('/events/{id}/book', [BookingController::class,'store'])->name('bookings.store');

    // การจองของฉัน
    Route::get('/my-bookings', [BookingController::class,'index'])->name('bookings.index');
    Route::post('/bookings/{id}/update-zone', [BookingController::class,'updateZone'])->name('bookings.update_zone');
    Route::post('/bookings/{id}/cancel', [BookingController::class,'cancel'])->name('bookings.cancel');

    // จองของที่ระลึก 
    //Route::get('/my-souvenirs', [SouvenirOrderController::class, 'index'])->name('souvenir_orders.index');
    //Route::post('/souvenirs/{id}/order', [SouvenirOrderController::class, 'store'])->name('souvenir_orders.store');
    //Route::post('/souvenir-orders/{id}/update-item', [SouvenirOrderController::class, 'updateItem'])->name('souvenir_orders.update_item');
    //Route::post('/souvenir-orders/{id}/cancel', [SouvenirOrderController::class, 'cancel'])->name('souvenir_orders.cancel');

});


