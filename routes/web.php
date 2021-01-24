<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::namespace('Auth')->group(function () {
    
    Route::get('login','LoginController@showLoginForm');
    Route::post('login','LoginController@login')->name('login');

    Route::get('register','RegisterController@showSignupForm');
    Route::post('register','RegisterController@register')->name('register');

    Route::post('logout','LoginController@logout')->name('logout');
  });

Route::get('/', function () {
    return view('auth.login');
});

Route::get('register', function () {
    return view('auth.register');
});

Route::middleware(['auth:web'])->group(function () {
    
    Route::get('dashboard', function () {
        return view('home');
    })->name('dashboard');
    
    Route::resource('users', 'UserController');
    Route::resource('ships', 'ShipController');
    Route::resource('notifications', 'NotificationController', ['except' => ['edit']]);
    Route::resource('crew', 'CrewMemberController');
    Route::resource('ranks', 'RankController');
    
    Route::fallback(function () {
        return back();
    });
});

