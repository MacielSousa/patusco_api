<?php

use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\RegisterController;
use App\Http\Controllers\Consult\Api\ConsultController;
use App\Http\Controllers\User\Api\UserController;
use App\Http\Middleware\CheckReceptionistOrDoctorRole;
use App\Http\Middleware\CheckReceptionistOrSameUserAsDoctor;
use App\Http\Middleware\CheckReceptionistRole;
use Illuminate\Support\Facades\Route;


Route::post('register', [UserController::class, 'registerUser']);

Route::prefix('auth')->group(function() {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('validate-token', [LoginController::class, 'validateToken'])->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum'])->prefix('consult')->group(function() {
    Route::post('register', [ConsultController::class, 'register']);
    Route::get('list', [ConsultController::class, 'list']);
    Route::get('filter', [ConsultController::class, 'filter'])->middleware(CheckReceptionistOrDoctorRole::class);
    Route::delete('delete/{id}', [ConsultController::class, 'delete'])->middleware(CheckReceptionistRole::class);
    Route::put('update/{id}', [ConsultController::class, 'update'])->middleware(CheckReceptionistOrSameUserAsDoctor::class);
    Route::get('getDoctors', [ConsultController::class, 'getDoctors'])->middleware(CheckReceptionistRole::class);
    Route::post('assign/consult/{consult_id}/doctor/{doctor_id}', [ConsultController::class, 'assignDoctor'])->middleware(CheckReceptionistRole::class);
});


Route::middleware(['auth:sanctum'])->prefix('user')->group(function() {
    Route::get('list', [UserController::class, 'listUserCommon'])->middleware(CheckReceptionistRole::class);
});