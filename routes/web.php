<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerRoomController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RoomController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Profile/Profile');
    })->name('dashboard');
});


Route::prefix('/dashboard')->group(function () {
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::put('/rooms', [RoomController::class, 'update'])->name('rooms.update');
    Route::post('/room/delete/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    Route::post('/room/{id}', [RoomController::class, 'edit'])->name('rooms.edit');
});

Route::prefix('/dashboard')->group(function () {
    Route::get('/custermers', [CustomerController::class, 'index'])->name('custermers.index');
});

Route::prefix('/dashboard/bokking')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/', [BookingController::class, 'store'])->name('bokking.store');
    Route::post('/delete/{id}', [BookingController::class, 'destroy'])->name('bokking.destroy');
    Route::post('/movetouse/{id}', [BookingController::class, 'moveToUse'])->name('bokking.movetouse');
});

Route::prefix('/dashboard/assingrooms')->group(function () {

    Route::get('/', [CustomerRoomController::class, 'index'])->name('assingroom.index');
    Route::post('/', [CustomerRoomController::class, 'store'])->name('assingroom.store');
    Route::post('/delete/{id}', [CustomerRoomController::class, 'destroy'])->name('assingroom.destroy');
});


Route::prefix('/profile')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Profile/Profile');
    })->name('profile');
});
