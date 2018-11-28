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
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/publish_delete/{id}', 'HomeController@publish_delete')->name('delete');
Route::get('/editar/{id}', 'HomeController@editar');
Route::get('/publish_editar/{id}', 'HomeController@publish_editar')->name('editar');
Route::get('/provas', 'HomeController@provas')->name('provas');
Route::get('/gabaritos', 'HomeController@gabaritos')->name('gabaritos');
Route::get('/apostilas', 'HomeController@apostila')->name('apostila');

Route::get('/error', 'HomeController@error');

Route::post('/publish', 'HomeController@publish');

