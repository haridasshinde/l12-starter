<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'index'])->name('users.index');

    Route::post('/user', [UserController::class, 'store'])->name('users.store');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
});
