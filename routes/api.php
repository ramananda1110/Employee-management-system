<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ChangePasswordController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'AuthController@login');


// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::get('/room-list', 'RoomController@roomList');
// });


Route::get('/room-list', 'RoomController@roomList');
Route::get('/employee-list', 'EmployeeController@getEmployee');

Route::get('/dashboard', 'RoomController@getDashboardInfo');


Route::group(['middleware' => ['auth:sanctum']], function () {
    //Route::get('/employee-list', 'EmployeeController@employeeList');

});

// Unauthenticated routes
Route::group(['middleware' => ['api.unauth']], function () {
    // Define unauthenticated routes here
    Route::post('/user/change-password', [ChangePasswordController::class, 'changePassword']);
});
