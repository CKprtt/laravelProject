<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageAccountController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");
    
    Route::get('/dashboard/manage', [ManageAccountController::class, 'index'])->name("ManageAccount");
    Route::get('/dashboard/manage/{id}/edit', [ManageAccountController::class, 'edit'])->name("Manage.edit");
    Route::post('/dashboard/manage/{id}/update', [ManageAccountController::class, 'update'])->name("Manage.update");
    Route::get('/dashboard/manage/{id}/delete', [ManageAccountController::class, 'destroy'])->name("Manage.destroy");
    
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name("profile");
    Route::get('/dashboard/profile/{id}/edit', [DashboardController::class, 'profile_edit'])->name("profile.edit");
    Route::post('/dashboard/profile/{id}/update', [DashboardController::class, 'profile_update'])->name("profile.update");
    Route::get('/dashboard/profile/{id}/delete', [DashboardController::class, 'profile_destroy'])->name("profile.destroy");
    
    
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');