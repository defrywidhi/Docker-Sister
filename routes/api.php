<?php

// use App\Http\Controllers\AuthController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MenageEmploye;
use App\Http\Controllers\PlantsController;
use App\Http\Controllers\PlantysController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::get('reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/users', [AuthController::class, 'users']);

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'employer'], function () {
    Route::post('/allEmploye', [MenageEmploye::class, 'all'])->name('allEmploye');    
});

// Route::middleware('auth:sanctum')->get('/tes', [PlantsController::class, 'tes']);

// Route::get('/users', [AuthController::class, 'allUsers'])->name('users');


//buat CRUD HARUS LEBIH DARI 1, CRUD USER, TABUNGAN, PINJAMAN, BERHASIL DITES DI POSTMAN
//SEKALIAN HOSTING KLO PENGNA BELAJAR (OPSIONAL)




//Planty
Route::middleware(['auth:sanctum'])->group(function(){
    // CRUD PLANTS LOCATION
    Route::apiResource('/locations', LocationController::class);
    Route::get('locations/show/{id}', [LocationController::class, 'show']);
    Route::post('locations/store', [LocationController::class, 'store']);
    Route::put('locations/update/{id}', [LocationController::class, 'update']);
    Route::delete('locations/destroy/{id}', [LocationController::class, 'destroy']);


    //CRUD PLANTY CATEGORY
    Route::apiResource('/ctgys', CategoryController::class);
    Route::get('ctgys/show/{id}', [CategoryController::class, 'show']);
    Route::post('ctgys/store', [CategoryController::class, 'store']);
    Route::put('ctgys/update/{id}', [CategoryController::class, 'update']);
    Route::delete('ctgys/destroy/{id}', [CategoryController::class, 'destroy']);

    //CRUD PLANTYS
    Route::apiResource('/plantys', PlantysController::class);
    Route::get('plantys/show/{id}', [PlantysController::class, 'show']);
    Route::post('plantys/store', [PlantysController::class, 'store']);
    Route::put('plantys/update/{id}', [PlantysController::class, 'update']);
    Route::post('plantys/update/{id}', [PlantysController::class, 'update']);
    Route::delete('plantys/destroy/{id}', [PlantysController::class, 'destroy']);
});