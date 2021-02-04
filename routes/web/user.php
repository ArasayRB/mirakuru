<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::get('/usersList', [App\Http\Controllers\UserController::class, 'getUsersList']);
Route::resource('/users', App\Http\Controllers\UserController::class);
Route::get('/roles-list',[App\Http\Controllers\UserController::class, 'allRoles']);
Route::get('/available-permissions/{role}',[App\Http\Controllers\RoleController::class, 'permissionsOfRole']);
