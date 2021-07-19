<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
Route::group(['prefix'=>'admin'],function(){
Route::resource('/hostals', App\Http\Controllers\HostalController::class)->middleware('role:admin');
Route::get('/hostalList', [App\Http\Controllers\HostalController::class, 'getHostalList']);
});
