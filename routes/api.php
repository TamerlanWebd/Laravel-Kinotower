<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FilmController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\AuthController;

Route::get('/films', [FilmController::class, 'index'])->name('api.films.index');
Route::get('/films/{id}', [FilmController::class, 'show'])->name('api.films.show');
Route::get('/categories', CategoryController::class)->name('api.categories.index');
Route::get('/countries', CountryController::class)->name('api.countries.index');
Route::get('/genders', GenderController::class)->name('api.genders.index');
Route::get('/films/{film_id}/reviews', ReviewController::class)->name('api.films.reviews');
Route::post('/auth/signup', [AuthController::class, 'signup'])->name('api.auth.signup');
Route::post('/auth/signin', [AuthController::class, 'signin'])->name('api.auth.signin');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/signout', [AuthController::class, 'signout'])->name('api.auth.signout');
});
