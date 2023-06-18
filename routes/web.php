<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\signUpController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\APIController;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* PAGES */

Route::get('/{lang}', function ($lang) { //signUp
    //App::setLocale($lang);
    app()->setLocale($lang);
    return view('index');
});
Route::get('/login/{lang}', function ($lang) { //Login
    // App::setLocale($lang);
    app()->setLocale($lang);
    return view('Login');
});

Route::get('/profile/{lang}', function ($lang) { //Profile
    app()->setLocale($lang);
    //App::setLocale($lang);
    return view('profile');
});

Route::get('/logout/en', function () { //Profile
    if (session()->has('img') && session()->has('username') && session()->has('email')) {
        session()->pull('img');
        session()->pull('username');
        session()->pull('email');
    }
    return redirect('login/en');
})->name('loggingOut');

/*CONTROLLERS*/
Route::post('/register', [signUpController::class, 'register'])->name('sendData');
Route::post('/verify', [SignInController::class, 'signIn'])->name('sendUserData');
Route::post('/getAPIData', [APIController::class, 'ContactWithAPI'])->name('GetAPIData');
Route::get('/testroute/{lang}', function ($lang) {
    app()->setLocale($lang);
    $name = "mohamed";

    // The email sending is done using the to method on the Mail facade
    Mail::to('muhamedamr241@gmail.com')->send(new WelcomeMail($name));
});
