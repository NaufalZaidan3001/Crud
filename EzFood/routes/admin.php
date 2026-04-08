<?php

use App\Http\Controllers\Admin\Approval;
use App\Http\Controllers\Auth\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

// Admin login routes (no auth required)
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

// Protected admin routes
Route::middleware(['auth', 'verified_or_admin'])->group(function () {
    Route::get('/admin/approval', [Approval::class, 'index'])->name('admin.approval');
    Route::post('/admin/approval/{id}/approve', [Approval::class, 'approve'])->name('admin.approval.approve');
    Route::post('/admin/approval/{id}/reject', [Approval::class, 'reject'])->name('admin.approval.reject');
});

Route::middleware(['auth', 'verified_or_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/restaurant/{id}/approve', [AdminDashboardController::class, 'approveRestaurant'])->name('restaurant.approve');
    Route::post('/restaurant/{id}/reject', [AdminDashboardController::class, 'rejectRestaurant'])->name('restaurant.reject');
    Route::post('/orders/{id}/update-status', [AdminDashboardController::class, 'updateOrderStatus'])->name('orders.updateStatus');
});
