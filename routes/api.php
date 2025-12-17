<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FilmController;
use App\Http\Controllers\Api\CategoryController;
Route::get('/films', [FilmController::class, 'index'])->name('api.films.index');
Route::get('/films/{id}', [FilmController::class, 'show'])->name('api.films.show');
Route::get('/categories',CategoryController::class)->name('api.categories.index');
