<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BooksController,
    UsersController,
    ReservationController,
};

Route::get('/books', [BooksController::class, 'index'])->name('books.index');    
Route::post('/books', [BooksController::class, 'store'])->name('books.store');
Route::delete('/books/{id}', [BooksController::class, 'destroy'])->name('books.destroy');
Route::get('/books/{id}', [BooksController::class, 'find'])->name('books.find');

Route::get('/users', [UsersController::class, 'index'])->name('users.index');    
Route::post('/users', [UsersController::class, 'store'])->name('users.store');

Route::get('/reserve', [ReservationController::class, 'index'])->name('reservation.index');    
Route::post('/reserve', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reserve/{user}', [ReservationController::class, 'find'])->name('reservation.find');
Route::delete('/reserve/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
