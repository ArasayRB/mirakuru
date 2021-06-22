<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
Route::get('/post-preview/{id}', [App\Http\Controllers\PostController::class, 'previewPost']);
Route::post('/publicate-post/{id}/{state}', [App\Http\Controllers\PostController::class, 'publicatePost']);
Route::resource('/posts', App\Http\Controllers\PostController::class)->middleware('role:admin,viewer-content,writer-content,publisher-content');
Route::get('/categoriesList', [App\Http\Controllers\PostController::class, 'getCategories']);
Route::get('/postsTable', [App\Http\Controllers\PostController::class, 'getPostAutentUser']);
Route::get('/available-tags', [App\Http\Controllers\PostController::class, 'getTags']);
Route::get('/available-keys', [App\Http\Controllers\PostController::class, 'availableKeys']);
