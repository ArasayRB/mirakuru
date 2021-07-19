<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::group(['prefix'=>'admin'],function(){
Route::get('/available-permissions/{role}',[App\Http\Controllers\RoleController::class, 'permissionsOfRole']);
Route::get('/rolesList', [App\Http\Controllers\RoleController::class, 'getRolesList']);
Route::resource('/roles', App\Http\Controllers\RoleController::class)->middleware('can:admin');
Route::get('/permissions-list',[App\Http\Controllers\RoleController::class, 'allPermissions']);
});
