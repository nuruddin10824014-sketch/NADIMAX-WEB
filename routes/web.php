<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HeartRateController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| User Management
|--------------------------------------------------------------------------
*/
Route::resource('users', UserController::class);

/*
|--------------------------------------------------------------------------
| Device Management
|--------------------------------------------------------------------------
*/
Route::resource('devices', DeviceController::class);

/*
|--------------------------------------------------------------------------
| Heart Rate
|--------------------------------------------------------------------------
*/
Route::resource('heart-rate', HeartRateController::class);

/*
|--------------------------------------------------------------------------
| Workout
|--------------------------------------------------------------------------
*/
Route::resource('workout', WorkoutController::class);

/*
|--------------------------------------------------------------------------
| Subscription
|--------------------------------------------------------------------------
*/
Route::resource('subscription', SubscriptionController::class);

/*
|--------------------------------------------------------------------------
| Report
|--------------------------------------------------------------------------
*/
Route::resource('reports', ReportController::class)->only([
    'index',
]);

/*
|--------------------------------------------------------------------------
| Setting
|--------------------------------------------------------------------------
*/
Route::resource('setting', SettingController::class);