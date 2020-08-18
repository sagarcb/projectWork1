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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Super Admin Routes
Route::get('/superadminlogin', 'SuperAdminController@showLoginForm');
Route::post('/superadmin', 'SuperAdminController@authenticate');
Route::group(['middleware' => 'superadmin'],function () {
    Route::get('/superadmin', 'SuperAdminController@index');
    Route::get('/superadmin/logout', "SuperAdminController@logout");
    Route::get('/superadmin/addadmin', 'SuperAdminController@create');
    Route::post('/superadmin/addadmin', 'SuperAdminController@store');
    Route::get('/superadmin/{empid}/edit', 'SuperAdminController@edit');
    Route::patch('/superadmin/{empid}', 'SuperAdminController@update');
    Route::delete('/superadmin/{empid}', 'SuperAdminController@destroy');
    Route::get('/superadmin/statusupdate', 'SuperAdminController@statusUpdate');

    Route::get('/superadmin/selectactivesemester','SuperAdminController@showActiveSemester');
    Route::post('/superadmin/selectactivesemester','SuperAdminController@activeSemesterStore');
    Route::get('/superadmin/selectactivesemester/activestatusupdate','SuperAdminController@activeSemesterStatusUpdate');

});

//Admin Routes
Route::get('/adminlogin', 'AdminController@showLoginForm');
Route::post('/admin', 'AdminController@authenticate');
Route::group(['middleware' => 'admin'],function () {
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/logout', "AdminController@logout");
    Route::get('/admin/addstudents','AdminController@showStudentAddForm');
    Route::post('/admin/addstudents','AdminController@store');
    Route::get('/admin/students','AdminController@showStudentList');
    Route::post('/admin/students','AdminController@postImport');

    Route::patch('/admin/{sid}', 'AdminController@update');
    Route::delete('/admin/{sid}', 'AdminController@destroy');
});

/*Student Routes*/
Route::get('/student','StudentController@index');
Route::get('/studentlogin','StudentController@showLoginForm');
