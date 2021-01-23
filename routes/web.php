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


// Route::middleware(['auth:web'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
// });

Route::resource('users', 'UserController');
Route::resource('ships', 'ShipController');
Route::resource('notifications', 'NotificationController');
Route::resource('crew', 'CrewMemberController');
Route::resource('ranks', 'RankController');
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
