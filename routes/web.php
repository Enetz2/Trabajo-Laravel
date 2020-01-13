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

//Rutas de google socialite
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('callback', 'Auth\LoginController@handleGoogleCallback');


Auth::routes();

//Rutas del profesor a las que el admin no puede entrar
Route::group(['middleware' => ['admin']], function () {
    Route::get('/nueva_incidencia',  function () {
        return view('nueva_incidencia');
    })->name('nueva_incidencia');
    Route::post('/homeinci','HomeController@añadirincidencia');
    Route::get('/homeinci','EmailController@añadir');
    Route::get('/correomodifi/{id}','EmailController@modificacion');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/edit/{id}', 'HomeController@editar');
    Route::post('/edit/{id}', 'HomeController@upgrade');
    Route::get('/eliminar/{id}', 'HomeController@eliminar');
});
//Rutas del admin a las que el profesor no puede entrar
Route::group(['middleware' => ['profe']], function () {
Route::get('/homeadmin', 'Admincontroller@homeadmin')->name('homeadmin');
Route::get('/estado/{id}', 'Admincontroller@estado');
Route::post('/estado/{id}', 'Admincontroller@añadirestado');
Route::get('/correoestado/{id}','EmailController@estado');
Route::get('/comentario/{id}', 'Admincontroller@comentario');
Route::post('/comentario/{id}', 'Admincontroller@añadircomentario');
});



