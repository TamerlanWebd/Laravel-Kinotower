<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// Маршруты для неавторизованных админов (без guest middleware, проверка в контроллере)
Route::get('/login', [AuthController::class, 'index'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');

// Маршруты для авторизованных админов
Route::middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::resource('countries', \App\Http\Controllers\Admin\CountryController::class)->except(['show']);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
    Route::resource('films', \App\Http\Controllers\Admin\FilmController::class)->except(['show']);
    
    // Управление жанрами фильмов
    Route::prefix('films/{film}')->name('films.')->group(function () {
        Route::get('categories', [\App\Http\Controllers\Admin\CategoryFilmController::class, 'index'])->name('categories.index');
        Route::post('categories', [\App\Http\Controllers\Admin\CategoryFilmController::class, 'store'])->name('categories.store');
        Route::delete('categories/{category}', [\App\Http\Controllers\Admin\CategoryFilmController::class, 'destroy'])->name('categories.destroy');
    });
    
    // Управление пользователями
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users/{user}/restore', [\App\Http\Controllers\Admin\UserController::class, 'restore'])->name('users.restore');
    
    // Управление отзывами
    Route::get('reviews', [\App\Http\Controllers\Admin\ReviewFilmController::class, 'index'])->name('reviews.index');
    Route::post('reviews/{review}/approve', [\App\Http\Controllers\Admin\ReviewFilmController::class, 'approve'])->name('reviews.approve');
    Route::delete('reviews/{review}', [\App\Http\Controllers\Admin\ReviewFilmController::class, 'destroy'])->name('reviews.destroy');
    
    // Управление оценками
    Route::get('ratings', [\App\Http\Controllers\Admin\RatingFilmController::class, 'index'])->name('ratings.index');
    Route::delete('ratings/{rating}', [\App\Http\Controllers\Admin\RatingFilmController::class, 'destroy'])->name('ratings.destroy');
});
