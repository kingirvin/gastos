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
    Route::get('/reporte/{id}','AdminController@reporte') ->middleware('usuario');
    Route::get('/reportepdf','AdminController@reportepdf') ->middleware('usuario');
    Route::get('/comprobantes','AdminController@comprobantes') ->middleware('usuario');
    Route::get('error_estado','AdminController@error_estado');
    Route::get('reporte/pdf/{inicio}/{fin}/{id}','AdminController@pdf')->middleware('usuario'); 

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

    Route::post('garantias/reporteBuscar','Api\GarantiaController@reporteBuscar')->middleware('usuario'); 
    Route::post('devolucion/reporteBuscar','Api\DevolucionController@reporteBuscar')->middleware('usuario'); 

    Route::get('comprobante/listar','Api\ComprobanteController@listar')->middleware('usuario')->name('listaComprobantes');      
    Route::post('comprobante/nuevo','Api\ComprobanteController@nuevo')->middleware('usuario');      
    Route::post('comprobante/buscar','Api\ComprobanteController@buscar')->middleware('usuario');      
    Route::post('comprobante/eliminar','Api\ComprobanteController@eliminar')->middleware('usuario');      


    Route::get('proveedor/listar/{busqueda}','Api\ProveedorController@listar')->middleware('usuario');      

    Route::get('usuarios/listar','Api\UserController@listar')->name('listaUsuarios')->middleware('usuario');      
    Route::post('/usuarios/nuevo','Api\UserController@nuevo')->middleware('usuario');      
    Route::post('/usuarios/estado','Api\UserController@estado')->middleware('usuario');      
    Route::post('/usuarios/buscar','Api\UserController@buscar')->middleware('usuario');      
    Route::post('/usuarios/password','Api\UserController@password')->middleware('usuario');      

    //Route::post('usuarios/nuevo','Api\DevolucionController@listar')->name('listaUsuarios');      
});
