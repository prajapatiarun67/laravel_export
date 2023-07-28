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

/* Route::get('/', function () {
    return view('welcome');
}); */


Route::any('/', 'App\Http\Controllers\StudentController@index')->name('student.index');
Route::any('/student', 'App\Http\Controllers\StudentController@index')->name('student.index');
Route::get('/student/create', 'App\Http\Controllers\StudentController@create')->name('student.cretate');
Route::post('/student/store', 'App\Http\Controllers\StudentController@store')->name('student.store');
Route::get('/student/{sid}/edit', 'App\Http\Controllers\StudentController@edit')->name('student.edit');
Route::post('/student/update/{sid}', 'App\Http\Controllers\StudentController@update')->name('student.update'); 
Route::get('/student/destroy/{sid}', 'App\Http\Controllers\StudentController@destroy')->name('student.destroy');
Route::get('/student/import', 'App\Http\Controllers\StudentController@import')->name('student.import');
Route::post('/student/import_store', 'App\Http\Controllers\StudentController@import_store')->name('student.import_store');
Route::get('/student/export', 'App\Http\Controllers\StudentController@export')->name('student.export');