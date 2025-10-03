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

// Artist
Route::get('/artist/request/create', [EventRequestController::class, 'create'])->name('artist.createRequest');
Route::post('/artist/request/store', [EventRequestController::class, 'store'])->name('artist.storeRequest');
Route::get('/artist/requests', [EventRequestController::class, 'myRequests'])->name('artist.requests');
Route::delete('/artist/requests/{id}', [EventRequestController::class, 'destroy'])->name('artist.requests.destroy');

// Admin
Route::get('/admin/requests', [EventRequestController::class, 'index'])->name('admin.requests');
Route::post('/admin/requests/{id}/approve', [EventRequestController::class, 'approve'])->name('admin.requests.approve');
Route::post('/admin/requests/{id}/reject', [EventRequestController::class, 'reject'])->name('admin.requests.reject');



