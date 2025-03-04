<?php

use Illuminate\Support\Facades\Route;

Route::resource('books', \App\Http\Controllers\BookController::class);

Route::resource('authors', \App\Http\Controllers\AuthorController::class);

Route::get('/', function () {
    return view('welcome');
});
