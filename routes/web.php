<?php

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

Route::get('tasks', 'TaskController@index')->name('tasks.index');

Route::post('tasks/add', 'TaskController@addTask')->name('tasks.store');

Route::post('tasks/categories/add', 'TaskController@addCategory')->name('categories.store');

Route::post('tasks/categories/update/{id?}', 'TaskController@updateCat')->name('categories.update');

Route::post('tasks/update/{id?}', 'TaskController@updateTask')->name('tasks.update');

Route::delete('tasks/categories/delete/{id}', [
    'uses' => 'TaskController@deleteCategory', 
    'as' => 'categories.delete'
]);

Route::delete('tasks/delete/{id}', [
    'uses' => 'TaskController@deleteTask', 
    'as' => 'tasks.delete'
]);

Route::post('tasks/update/status', 'TaskController@updateTaskStatus')->name('tasks.status');