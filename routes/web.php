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
    Route::get('ro_comprobantes','AdminController@roComprobantes') ->middleware('usuario');
    Route::get('rdr_comprobantes','AdminController@rdrComprobantes') ->middleware('usuario');
    Route::get('gar_comprobantes','AdminController@garComprobantes') ->middleware('usuario');
    Route::get('error_estado','AdminController@error_estado');
    Route::get('reporte/pdf/{inicio}/{fin}/{id}','AdminController@pdf')->middleware('usuario'); 
    Route::get('reporte/comprobante_pdf/{inicio}/{fin}/{id}','Api\ComprobanteController@pdf')->middleware('usuario'); 
    Route::get('comprobante/reporte','AdminController@comprobantes')->middleware('usuario'); 
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
//comprobantes RO
    Route::get('roComprobante/listar','Api\RoComprobanteController@listar')->middleware('usuario')->name('listaRoComprobantes');      
    Route::post('roComprobante/nuevo','Api\RoComprobanteController@nuevo')->middleware('usuario');      
    Route::post('roComprobante/buscar','Api\RoComprobanteController@buscar')->middleware('usuario');      
    Route::post('roComprobante/eliminar','Api\RoComprobanteController@eliminar')->middleware('usuario'); 
    //reporte de todos los comprobantes
    
    Route::post('comprobante/reporteBuscar','Api\ComprobanteController@reporteBuscar')->middleware('usuario'); 

    //comprobantes RO    
    Route::get('garComprobante/listar','Api\GarComprobanteController@listar')->middleware('usuario')->name('listaGarComprobantes');      
    Route::post('garComprobante/nuevo','Api\GarComprobanteController@nuevo')->middleware('usuario');      
    Route::post('garComprobante/buscar','Api\GarComprobanteController@buscar')->middleware('usuario');      
    Route::post('garComprobante/eliminar','Api\GarComprobanteController@eliminar')->middleware('usuario'); 
    
    //comprobantes rdr
    Route::get('rdrComprobante/listar','Api\RdrComprobanteController@listar')->middleware('usuario')->name('listaRdrComprobantes');      
    Route::post('rdrComprobante/nuevo','Api\RdrComprobanteController@nuevo')->middleware('usuario');      
    Route::post('rdrComprobante/buscar','Api\RdrComprobanteController@buscar')->middleware('usuario');      
    Route::post('rdrComprobante/eliminar','Api\RdrComprobanteController@eliminar')->middleware('usuario');      


    Route::get('proveedor/listar/{busqueda}','Api\ProveedorController@listar')->middleware('usuario');      

    Route::get('usuarios/listar','Api\UserController@listar')->name('listaUsuarios')->middleware('usuario');      
    Route::post('/usuarios/nuevo','Api\UserController@nuevo')->middleware('usuario');      
    Route::post('/usuarios/estado','Api\UserController@estado')->middleware('usuario');      
    Route::post('/usuarios/buscar','Api\UserController@buscar')->middleware('usuario');      
    Route::post('/usuarios/password','Api\UserController@password')->middleware('usuario');      

    //Route::post('usuarios/nuevo','Api\DevolucionController@listar')->name('listaUsuarios');      
});
