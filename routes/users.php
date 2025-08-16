<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Route::middleware('auth')->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});
