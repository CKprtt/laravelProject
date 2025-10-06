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
Route::get('/events', [EventPublicController::class,'indexEvent'])->name('home');
Route::get('/events/{id}', [EventPublicController::class,'showEvent'])->name('events.showEvent');

// ต้องล็อกอินก่อนจอง
Route::middleware(['auth','verified'])->group(function () {
    // จองตั๋ว
    Route::post('/events/{id}/book', [BookingController::class,'storeZone'])->name('bookings.storeZone');
    Route::get('/mybookings', [BookingController::class,'indexBooking'])->name('bookings.indexBooking');
    Route::post('/bookings/{id}/updateZone', [BookingController::class,'updateZone'])->name('bookings.updateZone');
    Route::post('/bookings/{id}/destroy', [BookingController::class,'destroy'])->name('bookings.destroy');

    // จองของที่ระลึก 
    Route::get('/mysouvenirs/history', [SouvenirOrderController::class, 'history'])->name('souvenirs.showSouvenir'); // ประวัติการจอง
    Route::get('/mysouvenirs', [SouvenirOrderController::class, 'indexSouvenir'])->name('souvenirs.indexSouvenir'); // แสดงรายการ
    Route::post('/souvenirs/{id}/order', [SouvenirOrderController::class, 'store'])->name('souvenirs.store'); // 
    Route::post('/souvenirs/{id}/destroy', [SouvenirOrderController::class, 'destroy'])->name('souvenirs.destroy'); // ยกเลิก
});


