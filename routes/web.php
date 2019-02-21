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
    return redirect('/dinamicas');
});

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@auth')->name('doLogin');

Route::get('/perfil', 'ProfileController@index')->name('profile');
Route::post('/perfil', 'ProfileController@update')->name('updateProfile');

Route::get('/dinamicas', 'DynamicController@index')->name('dashboard');
Route::get('/dinamicas/crear', 'DynamicController@create')->name('createDynamic');
Route::post('/dinamicas', 'DynamicController@store')->name('storeDynamic');
Route::get('/dinamicas/{code}', 'DynamicController@show')->name('showDynamic');
Route::get('/dinamicas/{code}/editar', 'DynamicController@edit')->name('editDynamic');
Route::put('/dinamicas/{id}', 'DynamicController@update')->name('updateDynamic');
Route::put('/dinamicas/{id}/open', 'DynamicController@open')->name('openDynamic');
Route::put('/dinamicas/{id}/close', 'DynamicController@close')->name('closeDynamic');
Route::delete('/dinamicas/{id}', 'DynamicController@delete')->name('deleteDynamic');

Route::post('/vote', 'VoteController@store')->name('vote');

Route::post('/proyectos', 'ProjectController@store')->name('storeProject');
Route::put('/proyectos/{id}', 'ProjectController@update')->name('updateProject');

Auth::routes();
