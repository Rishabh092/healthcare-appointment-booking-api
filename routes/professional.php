<?php

use Illuminate\Support\Facades\Route;
use App\Domains\HealthcareProfessional\Controllers\HealthcareProfessionalController;

Route::get('/professionals', [HealthcareProfessionalController::class, 'index']);