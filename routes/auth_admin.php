<?php

use App\Http\Controllers\Dashboard\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Dashboard\Auth\PasswordController;
use App\Http\Controllers\Dashboard\Auth\RegisteredAdminController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('admins', [RegisteredAdminController::class, 'show'])
        ->name('admins.show');
    Route::get('register', [RegisteredAdminController::class, 'create'])
        ->name('admin.register');
    Route::get('delete-admin/{id}', [RegisteredAdminController::class, 'delete'])
        ->name('admin.delete');
    Route::get('edit-admin/{id}', [RegisteredAdminController::class, 'edit'])
        ->name('admin.edit');
    Route::post('update-admin/{id}', [RegisteredAdminController::class, 'update'])
        ->name('admin.update');

    Route::post('register', [RegisteredAdminController::class, 'store'])->name("admin.reg.store");

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name("admin.store");

});

Route::middleware('admin')->group(function () {
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('admin.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('admin.password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');
});
