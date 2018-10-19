<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\Venta;
use \Session;


class ComprasController extends Controller
{


public function Miscompras()
	  {


	   	$usuario=json_decode(Session::get("cliente"));
	   	
		$miscompras = DB::table('ventas')
            ->join('pago','ventas.idpago','=','pago.id')
            ->select('ventas.fecha_venta','ventas.total','pago.estado')
          	->where('ventas.idcliente','=',$usuario->id)
            ->get();
	 

	  	return view('carrito.miscompras')->with('miscompras',$miscompras);
	  
	  }



}
