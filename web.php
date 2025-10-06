<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\EventRequestController;
use App\Http\Controllers\SouvenirRequestController;

// Artist
// คำขอจัดนิทัศการ
Route::get('/artist/my_requests', [EventRequestController::class, 'my'])->name('artist.my');
Route::get('/artist/request/create', [EventRequestController::class, 'create'])->name('artist.createRequest');
Route::post('/artist/request/insert', [EventRequestController::class, 'insert'])->name('artist.insertRequest');
Route::get('/artist/request/edit/{id}', [EventRequestController::class, 'edit'])->name('artist.editRequest');
Route::post('/artist/request/update/{id}', [EventRequestController::class, 'update'])->name('artist.updateRequest');
Route::delete('/artist/request/delete/{id}', [EventRequestController::class, 'destroy'])->name('artist.destroyRequest');
// คำขอแจกของที่ระลึก
Route::get('/artist/s/my_requests', [SouvenirRequestController::class, 'my'])->name('artist.S_my');
Route::post('/artist/s/request/create', [SouvenirRequestController::class, 'create'])->name('artist.S_create');
Route::post('/artist/s/request/insert', [SouvenirRequestController::class,'insert'])->name('artist.S_insert');
Route::get('/artist/s/request/edit/{id}', [SouvenirRequestController::class,'edit'])->name('artist.S_edit');
Route::post('/artist/s/request/update/{id}', [SouvenirRequestController::class,'update'])->name('artist.S_update');
Route::delete('/artist/s/request/delete/{id}', [SouvenirRequestController::class,'destroy'])->name('artist.S_destroy');

// Admin
// คำขอจัดนิทัศการ
Route::get('/admin/e/requests', [EventRequestController::class, 'adminIndex'])->name('admin.requests');
Route::post('/admin/e/requests/{id}/approve', [EventRequestController::class, 'approve'])->name('admin.requests.approve');
Route::post('/admin/e/requests/{id}/reject', [EventRequestController::class, 'unapprove'])->name('admin.requests.reject');

// คำขอแจกของที่ระลึก
Route::get('/admin/s/request', [SouvenirRequestController::class, 'adminIndex'])->name('admin.S_request');
Route::post('/admin/s/requests/{id}/approve', [SouvenirRequestController::class, 'approve'])->name('admin.S_approve');
Route::post('/admin/s/requests/{id}/reject', [SouvenirRequestController::class, 'unapprove'])->name('admin.S_reject');

