<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


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

## View
Route::get('/tasks', 'TaskController@index')->name('tasks');

## Create
Route::get('/tasks/create', 'TaskController@create')->name('tasks.create');
Route::post('/tasks/store', 'TaskController@store')->name('tasks.store');

## Update
Route::get('/tasks/store/{id}', 'TaskController@edit')->name('tasks.edit');
Route::post('/tasks/update/{id}', 'TaskController@update')->name('tasks.update');

## Delete
Route::get('/tasks/delete/{id}', 'TaskController@destroy')->name('tasks.delete');
