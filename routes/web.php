<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('main');
// TYPES
Route::resource('types', TypeController::class);
// VACATIONS
Route::resource('vacations', VacationController::class);
Route::post('vacations/{vacation}/comments', [CommentController::class, 'store'])->name('comments.store');
// PHOTOS
Route::delete('photos/destroy-multiple', [PhotoController::class, 'destroyMultiple'])->name('photos.destroy.multiple');
Route::resource('photos', PhotoController::class);
// BOOKINGS
Route::resource('bookings', BookingController::class);
// COMMENTS
// Route::resource('comments', CommentController::class);
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/edit', [HomeController::class, 'edit'])->name('home.edit');
Route::put('home/update', [HomeController::class, 'update'])->name('home.update');
