<?php

use Illuminate\Support\Facades\Route;
use App\Mascota;
use App\Propietario;
use Luecano\NumeroALetras\NumeroALetras;
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

Route::view('vue','pruebaVue');

// Ruta de tipo clousure
Route::get('prueba',function(){
	return Mascota::all();
});

Route::apiResource('apiMascota','MascotaController');
Route::apiResource('apiEspecie','EspecieController');
Route::apiResource('apiPropietario','PropietarioController');
Route::apiResource('apiProducto','ProductoController');
Route::apiResource('apiVenta','VentaController');


Route::view('mascotas','mascotas');
Route::view('ventas','ventas');
Route::view('productos','productos');



Route::get('pdf','ReporteController@pdf');
Route::get('convertir',function(){
	$convertir=new NumeroALetras();
	return $convertir->toMoney(1589.9,2,'PESOS','CENTAVOS');
});


// RUTA PARAMETRIZADAS

Route::get('getRazas/{id_especie}', [
    'as' => 'getRazas',
    'uses' => 'EspecieController@getRazas',
]);
//generar ticket
Route::get('ticket/{folio}',[
			'as'=>'ticket',
			'uses'=>'VentaController@ticket'
]);

