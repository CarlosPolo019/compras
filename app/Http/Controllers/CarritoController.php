<?php

namespace App\Http\Controllers;
use App\Producto;
use \stdClass;
use \Session;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
 

  public function Agregarproducto($idproducto,$cantidad)
	 {


	 	/*varriable carrito vacion*/
		 	$carrito=new stdClass();
	 	/*reestrurando carrito*/
	 	$carrito->total=0;
	 	$carrito->productos=[];
	 	/*Array con cerro elemto []*/

	 	/*recupera por completo recuperando y Retorna todo el producto de la DB*/
	 	$producto = Producto::find($idproducto);
	 	/*Si el carrito existe*/
	 	if (Session::has("carrito")) 
	 	{
	 		$carrito = json_decode(Session::get("carrito"));
	 	}

	 	/*Vrriable de control*/
	 	$producto_encontrado=false;
	 	/*esta vacio o no esta vacio */
	 	if (count($carrito->productos)>0) 
	 	{
	 		foreach ($carrito->productos as $itemProducto) 
	 		{
	 			if($itemProducto->id==$producto->id)
	 			{
	 				$producto_encontrado=true;
	 				$itemProducto->cantidad=$itemProducto->cantidad+$cantidad;
	 				$itemProducto->subtotal=$itemProducto->cantidad*$itemProducto->precio;

	 			}
	 		}
	 	}

	 	/*sI EL PRODUCTO NO A SIDO ENCONTRADO setear*/
	 	if (!$producto_encontrado) {
	 		$producto->cantidad=$cantidad;
	 		$producto->subtotal=$producto->precio*$cantidad;

	 		$carrito->productos[]=$producto;
	 	}

	 	$total=0;
	 	foreach ($carrito->productos as $producto) {
	 		$total=$total+$producto->subtotal;
	 	}

	 	$carrito->total=$total;

	 	Session::put("carrito",json_encode($carrito));

	 	//return json_encode($carrito);
	 	/*Pruba rapida
	 	return json_encode($carrito);*/

	 	//return view('carrito.carrito')->with("carrito",$carrito);
	 	return redirect('carrito');
}


	 public function Obtenercarrito()
{
	 	/* para Carrito vacio*/
	 	$carrito=new  stdClass();
	 	$carrito->total=0;
	 	$carrito->productos=[];

	 	if (Session::has("carrito")) 
	 
	 		$carrito = json_decode(Session::get("carrito"));
		
		return json_encode($carrito);
}

	 public function Limpiarcarrito()
	 {
	 	/* para Carrito vacio*/
	 	$carrito=new  stdClass();
	 	$carrito->total=0;
	 	$carrito->productos=[];
	 	Session::put("carrito",json_encode($carrito));
	 }

	 public function Index()
{
	 	return view('carrito.carrito');
}



	  public function Modificarproducto($idproducto, $cantidad)
	  {
	 	$carrito=new  stdClass();
	 	$carrito->total=0;
	 	$carrito->productos=[];

	 	if (Session::has("carrito"))
	 	{
	 		$carrito=json_decode(Session::get("carrito"));

	 	}

	 	for ($i=0; $i <count($carrito->productos) ; $i++) 
	 	{ 
	 		if ($carrito->productos[$i]->id==$idproducto) 
	 		{
	 			$carrito->productos[$i]->cantidad=$cantidad;
	 			$carrito->productos[$i]->subtotal=$cantidad*$carrito->productos[$i]->precio;
	 		}
	 	}

	 	$total=0;
	 	foreach ($carrito->productos as $producto) {
	 		$total=$total+$producto->subtotal;
	 	}

	 	$carrito->total=$total;

		Session::put("carrito",json_encode($carrito));

	  	return json_encode($carrito);

	  }

	  public function Eliminarproducto($idproducto)
	  {
	 	$carrito=new  stdClass();
	 	$carrito->total=0;
	 	$carrito->productos=[];

	 	if (Session::has("carrito"))
	 	{
	 		$carrito=json_decode(Session::get("carrito"));

	 	}


	  	for ($i=0; $i < count($carrito->productos); $i++) { 
	  		if ($carrito->productos[$i]->id==$idproducto) {
	  			array_splice($carrito->productos,$i,1);
	  			break;
	  		}
	  	}


	 	$total=0;
	 	foreach ($carrito->productos as $producto) {
	 		$total=$total+$producto->subtotal;
	 	}

	 	$carrito->total=$total;

	  	Session::put("carrito",json_encode($carrito));

	  	return json_encode($carrito);
	  }

}  
