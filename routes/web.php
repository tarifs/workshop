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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin
Route::group(['prefix' => 'admin','middleware' => ['auth','admin']], function () {
    Route::resource('users', 'Admin\UsersController', ['as' => 'admin'])->except('show');
    Route::post('json/users', 'Admin\UsersController@jsonIndex')->name('admin.json.users.index');
    Route::resource('tasks', 'Admin\TasksController', ['as' => 'admin']);
    Route::get('user/{user}/reverse-rule', 'Admin\UsersController@reverseRule')->name('admin.user.reverse.rule');
    Route::post('json/tasks', 'Admin\TasksController@jsonIndex')->name('admin.json.tasks.index');
});

// User
Route::group(['middleware'=>'auth'], function () {
    Route::resource('/tasks', 'User\TasksController')->only(['index']);
    Route::post('/task/{task}/complete', 'User\TasksController@taskComplete')->name('task.complete');
    Route::post('/json/tasks', 'User\TasksController@getJsonTask')->name('json.task');
});
