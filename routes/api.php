<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HeartRateApiController;
use App\Http\Controllers\Api\DashboardApiController;

Route::get('/dashboard/latest', [DashboardApiController::class, 'latest']);
Route::post('/heartrate', [HeartRateApiController::class, 'store']);