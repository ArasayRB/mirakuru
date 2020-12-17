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

Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware(['guest'])->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware(['guest'])->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->middleware(['guest'])->name('password.reset');

Route::get('/register-user', function () {
    return view('subview.registerUser');
});

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($request) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(Str::random(60));

            event(new PasswordReset($user));
        }
    );

    return $status == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => __($status)]);
})->middleware(['guest'])->name('password.update');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('language/{language}', [App\Http\Controllers\LanguageController::class, 'switchLang'])->name('language.select');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
Route::resource('/posts', App\Http\Controllers\PostController::class);
Route::get('/categoriesList', [App\Http\Controllers\PostController::class, 'getCategories']);
Route::get('/postsTable', [App\Http\Controllers\PostController::class, 'getPostAutentUser']);
Route::get('/available-tags', [App\Http\Controllers\PostController::class, 'getTags']);
Route::get('/available-keys', [App\Http\Controllers\PostController::class, 'availableKeys']);
Route::get('/welcome/{id}', [App\Http\Controllers\WelcomeController::class, 'showPost']);
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
Route::post('/contact', [App\Http\Controllers\ContactoController::class, 'store']);
