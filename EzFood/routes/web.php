<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Approval;
use App\Http\Controllers\Auth\Admin\AdminLoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\Restaurant\RestaurantRegisterController;
use App\Http\Controllers\Auth\Restaurant\RestaurantLoginCheck;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Restaurant\RestaurantDashboardController;

Route::view('/', 'auth.welcome')->name('beranda');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('restaurant/register', [RestaurantRegisterController::class, 'create'])
                ->name('restaurant.register');

    Route::post('restaurant/register', [RestaurantRegisterController::class, 'store']);

    Route::get('restaurant/login', [RestaurantLoginCheck::class, 'showRestaurantLogin'])
                ->name('restaurant.login');

    Route::post('restaurant/login', [RestaurantLoginCheck::class, 'loginRestaurant'])
                ->name('restaurant.login.submit');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::middleware(['auth', 'verified_or_admin'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/restaurant/dashboard', [RestaurantDashboardController::class, 'index'])->name('restaurant.dashboard');
    Route::view('/restaurant/pending', 'auth.restaurant-pending')->name('restaurant.pending');

    // Menu routes — shared between customers (view/show) and restaurant owners (full CRUD)
    Route::resource('menu', MenuController::class);

    // Order routes (customers and restaurants rely on this)
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');

    // Cart and Checkout routes
    Route::post('/basket/add/{menu}', [CartController::class, 'add'])->name('basket.add');
    Route::post('/basket/remove/{id}', [CartController::class, 'remove'])->name('basket.remove');
    Route::post('/basket/clear', [CartController::class, 'clear'])->name('basket.clear');
    Route::post('/basket/checkout', [CartController::class, 'checkout'])->name('basket.checkout');
});

// Admin login routes (no auth required)
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

// Protected admin routes
Route::middleware(['auth', 'verified_or_admin'])->group(function () {
    Route::get('/admin/approval', [Approval::class, 'index'])->name('admin.approval');
    Route::post('/admin/approval/{id}/approve', [Approval::class, 'approve'])->name('admin.approval.approve');
    Route::post('/admin/approval/{id}/reject', [Approval::class, 'reject'])->name('admin.approval.reject');
});