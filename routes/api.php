<?php

use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Bookings API
    Route::controller(BookingController::class)->group(function () {
        Route::get('/bookings', 'index')->name('api.bookings.index');
        Route::post('/bookings', 'store')->name('api.bookings.store');
        Route::get('/bookings/{booking}', 'show')->name('api.bookings.show');
        Route::post('/bookings/{booking}/cancel', 'cancel')->name('api.bookings.cancel');
    });

    // Reviews API
    Route::controller(ReviewController::class)->group(function () {
        Route::post('/rooms/{room}/reviews', 'store')->name('api.reviews.store');
    });

    // Statistics (Admin only)
    Route::get('/statistics/bookings', [BookingController::class, 'statistics'])->name('api.statistics.bookings');
});

// Public API Routes
Route::prefix('public')->group(function () {
    // Rooms API (Public)
    Route::controller(RoomController::class)->group(function () {
        Route::get('/rooms', 'index')->name('api.public.rooms.index');
        Route::get('/rooms/{room}', 'show')->name('api.public.rooms.show');
        Route::get('/rooms/search/advanced', 'search')->name('api.public.rooms.search');
    });

    // Reviews API (Public - Read only)
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/rooms/{room}/reviews', 'index')->name('api.public.reviews.index');
        Route::get('/rooms/{room}/reviews/statistics', 'statistics')->name('api.public.reviews.statistics');
    });

    // Room Availability (Public)
    Route::get('/rooms/{room}/availability', [RoomController::class, 'availability'])->name('api.public.rooms.availability');
});

