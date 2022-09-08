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
    return view('auth./login');
});
Route::post('nuevo','Api\GastosController@nuevo');      

Auth::routes();
//AJAX
Route::prefix('vista')->group(function () {
    Route::get('giro','AdminController@giro');     
    Route::get('conciliacion','AdminController@conciliacion');      
    Route::get('usuarios','AdminController@usuario') ;     
});
Route::prefix('json')->group(function () {
    Route::get('giro/listar','Api\GiroController@listar')->name('listaGiro');      
    Route::get('conciliacion/listar','Api\ConciliacionController@listar')->name('listaConciliacion');      
    Route::post('giro/nuevo','Api\GiroController@nuevo'); 
    Route::post('conciliacion/nuevo','Api\ConciliacionController@nuevo'); 
    Route::post('conciliacion/buscar','Api\ConciliacionController@buscar'); 
    Route::post('conciliacion/eliminar','Api\ConciliacionController@eliminar');
    Route::get('conciliacion/listaidnombre','Api\ConciliacionController@listaIdNombre'); 

    Route::get('usuarios/listar','Api\UserController@listar')->name('listaUsuarios');      
    Route::post('/usuarios/nuevo','Api\UserController@nuevo');      
    Route::post('/usuarios/estado','Api\UserController@estado');      

    //Route::post('usuarios/nuevo','Api\GiroController@listar')->name('listaUsuarios');      
});
