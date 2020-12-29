<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
App::setLocale("en");

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'welcome'])->name('welcome');


Route::get('/post-list/{id}', [App\Http\Controllers\WelcomeController::class, 'showPost']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('language/{language}', [App\Http\Controllers\LanguageController::class, 'switchLang'])->name('language.select');
Route::post('/suscripcion', [App\Http\Controllers\SuscripcionController::class, 'store']);
Route::get('/unsubscribe/{suscriptor}/{hostal}', [App\Http\Controllers\SuscripcionController::class, 'delete'])->middleware(['guest'])->name('unsubscribe');
Route::resource('/reserva', App\Http\Controllers\ReservaController::class);
Route::get('/available-services/{hostal}', [App\Http\Controllers\ReservaController::class, 'getHostalServices']);
Route::get('/available-rooms/{hostal}', [App\Http\Controllers\ReservaController::class, 'getHostalRooms']);
Route::get('/countries-list', [App\Http\Controllers\ReservaController::class, 'getCountries']);
Route::get('/temporadas-hostal/{hostal}', [App\Http\Controllers\TemporadaHostalController::class, 'getTemporadasAvailable']);
Route::get('/confirm-reservation/{token}/{reservation}/{user}', [App\Http\Controllers\ReservaController::class, 'confirmReservation'])->name('confirm-reservation');
Route::get('/blocked-dates/{hostal}', [App\Http\Controllers\ReservaController::class, 'getBlockedDates']);
Route::get('/user-perfil', [App\Http\Controllers\UserController::class, 'index'])->name('user-perfil');
Route::get('/active-books', [App\Http\Controllers\ReservaController::class, 'activeBooks'])->name('active-books');
Route::get('/active-books-list', [App\Http\Controllers\ReservaController::class, 'listBooksByUser'])->name('active-books-list');
Route::post('/delete-book-by-guest/{book}/{email}/{name}', [App\Http\Controllers\ReservaController::class, 'deleteBookByUser'])->name('delete-book-by-guest');
Route::get('/exist-post', [App\Http\Controllers\PostController::class, 'existPost']);
Route::get('/qr-generate', [App\Http\Controllers\QRController::class, 'qrGenerate']);
Route::post('/contact', [App\Http\Controllers\ContactoController::class, 'store']);
Route::post('/post-love/{id}', [App\Http\Controllers\WelcomeController::class, 'addLove']);
Route::post('/share/{id}/{media}', [App\Http\Controllers\WelcomeController::class, 'sharePostMedia']);
Route::get('/gallery', function(){
  return view('galeria');
});
