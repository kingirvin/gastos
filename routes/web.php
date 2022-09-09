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
Auth::routes([
    'register' => false, //Desactivamos pagina de registro
    'reset' => false, //Desactivamos pagina de reset contraseña
    'verify' => false, //Desactivamos pagina de verificacion por email
]);

Route::get('/', function () {
    return view('auth./login');
});

Auth::routes();
//AJAX
Route::prefix('vista')->group(function () {
    Route::get('devoluciones','AdminController@devolucion')->middleware('usuario');     
    Route::get('garantias','AdminController@garantia')->middleware('usuario');      
    Route::get('usuarios','AdminController@usuario') ->middleware('usuario');
    Route::get('error_estado','AdminController@error_estado');      
});
Route::prefix('json')->group(function () {
    Route::get('devolucion/listar','Api\DevolucionController@listar')->middleware('usuario')->name('listaDevolucion');      
    Route::get('garantia/listar','Api\GarantiaController@listar')->middleware('usuario')->name('listagarantia');      
    Route::post('devolucion/nuevo','Api\DevolucionController@nuevo')->middleware('usuario');
    Route::post('devolucion/buscar','Api\DevolucionController@buscar')->middleware('usuario'); 
    Route::post('garantia/nuevo','Api\GarantiaController@nuevo')->middleware('usuario'); 
    Route::post('garantia/buscar','Api\GarantiaController@buscar')->middleware('usuario'); 
    Route::post('garantia/eliminar','Api\GarantiaController@eliminar')->middleware('usuario');
    Route::get('garantia/listaidnombre','Api\GarantiaController@listaIdNombre')->middleware('usuario'); 

    Route::get('usuarios/listar','Api\UserController@listar')->name('listaUsuarios')->middleware('usuario');      
    Route::post('/usuarios/nuevo','Api\UserController@nuevo')->middleware('usuario');      
    Route::post('/usuarios/estado','Api\UserController@estado')->middleware('usuario');      

    //Route::post('usuarios/nuevo','Api\DevolucionController@listar')->name('listaUsuarios');      
});
