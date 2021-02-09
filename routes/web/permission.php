<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::get('/permissionsList', [App\Http\Controllers\PermissionController::class, 'getPermissionList']);
Route::resource('/permissions', App\Http\Controllers\PermissionController::class)->middleware('can:admin');
