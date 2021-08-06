<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
Route::group(['prefix'=>'admin'],function(){
Route::resource('/services', App\Http\Controllers\ServiceController::class)->middleware('role:admin');
Route::get('/serviceList', [App\Http\Controllers\ServiceController::class, 'getServiceList']);
Route::get('/all-services', [App\Http\Controllers\ServiceController::class, 'getAllServices']);
});
