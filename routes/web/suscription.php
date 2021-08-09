<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
Route::group(['prefix'=>'admin'],function(){
Route::resource('/suscriptions', App\Http\Controllers\SuscripcionController::class,['except'=>['create','edit','store','destroy']])->middleware('role:admin','auth');
Route::delete('/suscriptions/{suscriptor}/{hostal}', [App\Http\Controllers\SuscripcionController::class, 'delete'])->middleware('role:admin','auth');
Route::get('/suscriptionList', [App\Http\Controllers\SuscripcionController::class, 'getSuscriptionsList']);
Route::get('/all-suscriptions', [App\Http\Controllers\SuscripcionController::class, 'getAllSuscriptions']);
});
