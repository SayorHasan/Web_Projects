<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TurfController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Home route (redirects based on role)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// User routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    
    // Booking routes
    Route::get('/user/book-turf', [TurfController::class, 'available'])->name('user.book-turf');
    Route::post('/user/book-turf', [BookingController::class, 'store'])->name('user.bookings.store');
    Route::get('/user/bookings', [BookingController::class, 'userBookings'])->name('user.bookings.index');
    Route::patch('/user/bookings/{booking}/cancel', [BookingController::class, 'cancelBooking'])->name('user.bookings.cancel');
    
    // Profile routes
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('user.profile');
    Route::put('/user/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::put('/user/profile/password', [ProfileController::class, 'changePassword'])->name('user.profile.password');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::post('/admin/users', [AdminDashboardController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/admin/users/{user}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminDashboardController::class, 'destroyUser'])->name('admin.users.destroy');
    
    // Admin profile routes
    Route::get('/admin/profile', [ProfileController::class, 'show'])->name('admin.profile');
    Route::put('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('/admin/profile/password', [ProfileController::class, 'changePassword'])->name('admin.profile.password');
    
    // Turf management routes
    Route::resource('admin/turfs', TurfController::class)->names([
        'index' => 'admin.turfs.index',
        'create' => 'admin.turfs.create',
        'store' => 'admin.turfs.store',
        'show' => 'admin.turfs.show',
        'edit' => 'admin.turfs.edit',
        'update' => 'admin.turfs.update',
        'destroy' => 'admin.turfs.destroy',
    ]);
    
    // Booking management routes
    Route::resource('admin/bookings', BookingController::class)->names([
        'index' => 'admin.bookings.index',
        'create' => 'admin.bookings.create',
        'store' => 'admin.bookings.store',
        'show' => 'admin.bookings.show',
        'edit' => 'admin.bookings.edit',
        'update' => 'admin.bookings.update',
        'destroy' => 'admin.bookings.destroy',
    ]);
    Route::patch('/admin/bookings/{booking}/confirm', [BookingController::class, 'confirmBooking'])->name('admin.bookings.confirm');
    Route::patch('/admin/bookings/{booking}/complete', [BookingController::class, 'completeBooking'])->name('admin.bookings.complete');
    Route::patch('/admin/bookings/{booking}/cancel', [BookingController::class, 'cancelAdminBooking'])->name('admin.bookings.cancel');
    
    // Carousel management routes
    Route::resource('admin/carousel', CarouselController::class)->names([
        'index' => 'admin.carousel.index',
        'create' => 'admin.carousel.create',
        'store' => 'admin.carousel.store',
        'show' => 'admin.carousel.show',
        'edit' => 'admin.carousel.edit',
        'update' => 'admin.carousel.update',
        'destroy' => 'admin.carousel.destroy',
    ]);
    Route::get('/admin/carousel/missing-images', [CarouselController::class, 'checkMissingImages'])->name('admin.carousel.missing-images');
});
