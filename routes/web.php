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

Route::get('/', 'InicioController@index')->name('inicio.index');

Route::get('/cursos', 'CursoController@index')->name('cursos.index');
Route::get('/cursos/create', 'CursoController@create')->name('cursos.create');
Route::post('/cursos', 'CursoController@store')->name('cursos.store');
Route::get('/cursos/{curso}', 'CursoController@show')->name('cursos.show');
Route::get('/cursos/{curso}/edit', 'CursoController@edit')->name('cursos.edit');
Route::put('/cursos/{curso}', 'CursoController@update')->name('cursos.update');
Route::delete('/cursos/{curso}','CursoController@destroy')->name('cursos.destroy');

Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit', 'PerfilController@edit')->name('perfiles.edit');
Route::put('/perfiles/{perfil}', 'PerfilController@update')->name('perfiles.update');

//payment
Route::get('/paypal/pay','PaymentController@payWithPayPal');
Route::get('/paypal/status','PaymentController@payPalStatus');

Auth::routes();
