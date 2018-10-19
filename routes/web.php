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



//Carrito
Route::get("carrito","CarritoController@index");

Route::get('carrito/agregarproducto/{id}/{cant}', ['as' => 'AgregarCarrito', 'uses' => 'CarritoController@Agregarproducto']);


/*
Route::post("/clientes","ClienteController");

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