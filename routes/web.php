<?php

use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\User\MovieController as UserMovieController;
use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('movies', MovieController::class);
    Route::resource('showtimes', ShowtimeController::class);
    Route::resource('seats', Admin\SeatController::class);
});

// user
Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('movies', [App\Http\Controllers\User\MovieController::class, 'index'])->name('movies.index');
    Route::get('movies/{id}', [UserMovieController::class, 'show'])->name('movies.show');
});

// booking
Route::middleware(['auth'])->group(function () {
    Route::get('showtime/{showtime_id}/book', [BookingController::class, 'book'])->name('user.booking');
    Route::post('showtime/{showtime_id}/book/confirm', [BookingController::class, 'confirm'])->name('user.confirm.booking');
    Route::get('booking/success', [BookingController::class, 'success'])->name('user.booking.success');
});


require __DIR__.'/auth.php';
