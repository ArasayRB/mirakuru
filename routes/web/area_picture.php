<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
Route::group(['prefix'=>'admin'],function(){
Route::resource('/area_pictures', App\Http\Controllers\AreaPictureController::class)->middleware('role:admin');
Route::get('/areaPictureList', [App\Http\Controllers\AreaPictureController::class, 'getAreaPictureList']);
});
