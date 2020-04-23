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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('VehicleList', 'VehicleListController@getVehicleData');
Route::post('avatar/store','ImageService@storeAvatar');
Route::post('SpLogo/store','ImageService@storeSPLogo');
Route::get('avatar/{imageName?}','ImageService@avatar');
Route::get('SpLogo/{imageName?}','ImageService@sPLogo');
Route::group([
  'prefix' => 'auth'
], function () {
  Route::post('login', 'AuthController@login');
  Route::post('register', 'AuthController@register');
  Route::group([
    'middleware' => 'auth:api'
  ], function() {
      Route::get('logout', 'AuthController@logout');
      Route::get('user', 'AuthController@user');
  });
});
