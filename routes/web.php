<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('employee', 'admin.create');





Route::group(['middleware'=> ['auth', 'has.permission']], function(){

    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::resource('departments', 'DepartmentController');
    Route::get('/department-list', 'DepartmentController@getDepartment');

    

    Route::resource('roles', 'RoleController');

    Route::resource('users', 'UserController');
    Route::get('/user-list', 'UserController@listOfUser');

    Route::resource('permissions', 'PermissionController');

    Route::resource('notices', 'NoticeController');

    Route::resource('leaves', 'LeaveController');
    Route::post('accept-reject-leave\{id}', 'LeaveController@acceptReject')->name('accept.reject');


});



