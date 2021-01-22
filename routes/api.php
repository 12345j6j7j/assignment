<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', 'API\UserController@index')->name('api.users');
Route::get('notifications', 'API\NotificationController@index')->name('api.notifications');
Route::get('ranks', 'API\RankController@index')->name('api.ranks');
Route::get('ships', 'API\ShipController@index')->name('api.ships');
Route::get('crew-members', 'API\CrewMemberController@index')->name('api.crew');