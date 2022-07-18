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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//User endpoints
Route::post('/auth/register', '\App\Http\Controllers\AuthController@store');
Route::post('/auth/login', '\App\Http\Controllers\AuthController@login');
Route::get('/auth/profile/{id}', '\App\Http\Controllers\AuthController@show')->middleware('auth:api');
Route::get('/auth/users', '\App\Http\Controllers\AuthController@users')->middleware('auth:api');
