<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\BookController::class, 'index'])->name('books.index');
Route::get('/authors', [\App\Http\Controllers\AuthorController::class, 'index'])->name('authors.index');
Route::get('/ratings', [\App\Http\Controllers\RatingController::class, 'index'])->name('ratings.index');
Route::post('/ratings', [\App\Http\Controllers\RatingController::class, 'store'])->name('ratings.store');
Route::get('/authors/{author}/books', [\App\Http\Controllers\RatingController::class, 'getBooksByAuthor'])->name('authors.books');