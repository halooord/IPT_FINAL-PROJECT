<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CounselorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CounselingRecordController;
use App\Http\Controllers\ReferralController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('students', StudentController::class);
Route::resource('counselors', CounselorController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('counseling-records', CounselingRecordController::class);
Route::resource('referrals', ReferralController::class);