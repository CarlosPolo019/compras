<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprasController extends Controller
{


public function getMiscompras()
	  {
	  	$usuario=json_decode(Session::get("cliente"));
		$miscompras = DB::table('ventas')
            ->where('idcliente','=',$usuario->id)
            ->get();
	 
	  	return view('carrito.miscompras')->with('miscompras',$miscompras);
	  
	  }



}
