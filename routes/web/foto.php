<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::resource('/fotos', App\Http\Controllers\FotoController::class);
Route::get('/gallery/{hostal}',  [App\Http\Controllers\FotoController::class, 'gallery'])->name('gallery');
