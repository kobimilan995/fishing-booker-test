<?php

use Illuminate\Http\Request;

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

Route::post('/register', 'JwtAuth\AuthController@register');
Route::post('/login', 'JwtAuth\AuthController@login');
Route::get('/test', function() {
    return 'TEST';
})->middleware('jwt.auth');


Route::get('/gmdate', function() {
    return [
        'gmdate' => gmdate('d/m/Y, H:i:s')
    ];
});
