<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('welcome');
});
Route::get('/inicio', function () {
    return view('welcome');
});
Route::get('/cotizar/{id}', function () {
    return view('welcome');
});

Route::post('proveedor', 'ProveedorController@create');
Route::put('proveedor', 'ProveedorController@update');
Route::post('cotizacion', 'CotizacionController@create');
Route::put('cotizacion', 'CotizacionController@update');
Route::post('login', 'Auth\AuthController@postLogin');

Route::post('cotizacion/cantidad/{cantidad}/pagina/{pagina}', 'CotizacionController@busquedaPaginada')->middleware('jwt.auth');
Route::get('cotizacionproveedor/{id}', 'CotizacionProveedorController@leer');
Route::put('cotizacionproveedor', 'CotizacionProveedorController@update');
Route::get('cotizacionproveedor/obtenerparacomparar/{cotizacionId}', 'CotizacionController@obtenerParaComparar');

Route::get('tipomoneda', 'TipoMonedaController@listar');
