<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentController;

Route::resource('books', \App\Http\Controllers\BookController::class);

Route::resource('authors', \App\Http\Controllers\AuthorController::class);

Route::get('/rents/create/{book}', [RentController::class, 'create'])->name('rents.create');
Route::post('/rents/store/{book}', [RentController::class, 'store'])->name('rents.store');
Route::put('/rents/{rent}/return/{notification}', [RentController::class, 'returnBook'])->name('rents.return');
Route::delete('/rents/{rent}/return', [RentController::class, 'returnBook'])->name('rents.return');
Route::get('/rents', [RentController::class, 'index'])->name('rents.index');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
