<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\WebCategoryController;
use App\Http\Controllers\WebLocationController;
use App\Http\Controllers\WebPlantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('categories')->group(function () {
    Route::get('/', [WebCategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [WebCategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [WebCategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}', [WebCategoryController::class, 'show'])->name('categories.show');
    Route::get('/{id}/edit', [WebCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{id}', [WebCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [WebCategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::prefix('locations')->group(function () {
    Route::get('/', [WebLocationController::class, 'index'])->name('locations.index');
    Route::get('/create', [WebLocationController::class, 'create'])->name('locations.create');
    Route::post('/', [WebLocationController::class, 'store'])->name('locations.store');
    Route::get('/{id}', [WebLocationController::class, 'show'])->name('locations.show');
    Route::get('/{id}/edit', [WebLocationController::class, 'edit'])->name('locations.edit');
    Route::put('/{id}', [WebLocationController::class, 'update'])->name('locations.update');
    Route::delete('/{id}', [WebLocationController::class, 'destroy'])->name('locations.destroy');
});

Route::prefix('plants')->group(function () {
    Route::get('/', [WebPlantController::class, 'index'])->name('plants.index');
    Route::get('/create', [WebPlantController::class, 'create'])->name('plants.create');
    Route::post('/', [WebPlantController::class, 'store'])->name('plants.store');
    Route::get('/{id}', [WebPlantController::class, 'show'])->name('plants.show');
    Route::get('/{id}/edit', [WebPlantController::class, 'edit'])->name('plants.edit');
    Route::put('/{id}', [WebPlantController::class, 'update'])->name('plants.update');
    Route::delete('/{id}', [WebPlantController::class, 'destroy'])->name('plants.destroy');
});

Route::get('/login', [AuthWebController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthWebController::class, 'login'])->name('login');
Route::get('/register', [AuthWebController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthWebController::class, 'register'])->name('register');
Route::get('/forgot-password', [AuthWebController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthWebController::class, 'forgotPassword'])->name('password.email');
Route::get('/reset-password/{token}', [AuthWebController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthWebController::class, 'resetPassword'])->name('password.update');
Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');
