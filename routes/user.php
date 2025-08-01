<?php

use Illuminate\Support\Facades\Route;
use App\Domains\User\Controllers\UserController;

Route::middleware('auth:api')->prefix('user')->group(function () {
    Route::get('profile', [UserController::class, 'profile']);
});