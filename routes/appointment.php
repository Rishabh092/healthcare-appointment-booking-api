<?php
use Illuminate\Support\Facades\Route;
use App\Domains\Appointment\Controllers\AppointmentController;

Route::middleware('auth:api')->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments', [AppointmentController::class, 'book']);
    Route::delete('/appointments/{id}', [AppointmentController::class, 'cancel']);
});