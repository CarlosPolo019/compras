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
Route::get('/', function()
{
	return redirect('home');
});

Route::get('home','HomeController@index')->name("index");



//CARRITO
Route::get("carrito","CarritoController@index");

Route::get('carrito/agregarproducto/{id}/{cant}', ['as' => 'AgregarCarrito', 'uses' => 'CarritoController@Agregarproducto']);

Route::get('carrito/obtenercarrito','CarritoController@Obtenercarrito')->name('Obtenercarrito');

Route::get('carrito/eliminarproducto/{id}', ['as' => 'Eliminarproducto', 'uses' => 'CarritoController@Eliminarproducto']);

Route::get('carrito/modificarproducto/{id}/{cant}', ['as' => 'Modificarproducto', 'uses' => 'CarritoController@Modificarproducto']);




// COMPRAS

Route::get('compras/miscompras','ComprasController@Miscompras')->name('Miscompras');

// LOGIN

Route::get('/login', function()
{
	return View('login');
})->name("login");

//CLIENTE

Route::post("clientes/autenticarcliente","ClienteController@Autenticarcliente")->name("Autenticarcliente");


Route::get("clientes/cerrarsession
","ClienteController@Cerrarsession")->name("Cerrarsession");


//PAGO

Route::get('pagos/obtenerinformacionpago/{monto}', ['as' => 'Obtenerinformacionpago', 'uses' => 'PagoController@Obtenerinformacionpago']);


Route::get('pagos/respuestapagos','PagoController@Respuestapagos')->name("Respuestapagos");
Route::get('pagos/confirmacionpagos','PagoController@Confirmacionpagos')->name("Confirmacionpagos");




/*

Route::post("/pagos","PagoController");





Route::get('/login', function()
{
	return View::make('login');
});




Route::group(array('before'=>'auth'), function()
	{
		

		Route::post("/compras","ComprasController");
	
	}
	);*/