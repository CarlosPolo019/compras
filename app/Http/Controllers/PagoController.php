<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Session;
use \stdClass;
use App\Pago;
use App\Detalleventa;
use App\Venta;
use DateTime;

class PagoController extends Controller
{
   public function Obtenerinformacionpago($monto)
	{

		$api_key="4Vj8eK4rloUd272L48hsrarnUA";

		$email_cliente="cliente1@syslacstraining.com";

		if(Session::has("cliente"))
		{
			$cliente=json_decode(Session::get("cliente"));
			$email_cliente=$cliente->correo_electronico;
		}

		$info_pago=new stdClass();

		$info_pago->merchantId="508029";
		$info_pago->accountId="512321";
		$info_pago->description="MIS VENTAS EN LINEA";
		$info_pago->referenceCode="PAGO002";
		$info_pago->amount=$monto;
		$info_pago->tax="0";
		$info_pago->taxReturnBase="0";
		$info_pago->currency="COP";
		$info_pago->signature=md5($api_key."~".$info_pago->merchantId."~".$info_pago->referenceCode."~".$monto."~COP");
		$info_pago->test="1";
		$info_pago->buyerEmail=$email_cliente;
		$info_pago->responseUrl="http://localhost/compras/public/pagos/respuestapagos";
		$info_pago->confirmationUrl="http://localhost/compras/public/pagos/confirmacionpagos";


		return  json_encode($info_pago);


	} 

	public function Respuestapagos()
	{

		$transactionState = $_REQUEST['transactionState'];
		$processingDate	=$_REQUEST['processingDate'];
		$buyerEmail=$_REQUEST['buyerEmail'];
		$transactionId = $_REQUEST['transactionId'];

		if($transactionState==4)
		{

			$pago = new Pago();

		  	$pago->idtransaccion=$transactionId;
		  	$pago->estado=$transactionState;
		  	$pago->idclientepago=$buyerEmail;

		  	$pago->save();

		  	$usuario=json_decode(Session::get("cliente"));
			$carrito=json_decode(Session::get("carrito"));

		  	$venta = new Venta();
		  	$venta->idcliente=$usuario->id;
		  	$venta->fecha_venta=new DateTime();
		  	$venta->idpago=$pago->id;
		  	$venta->total=$carrito->total;

		  	$venta->save();

		  	

		  	foreach ($carrito->productos as $itemProducto)
		  	{
		  		$detalleventa=new Detalleventa();
		  		$detalleventa->idventa=$venta->id;
		  		$detalleventa->idproducto=$itemProducto->id;
		  		$detalleventa->cantidad=$itemProducto->cantidad;
		  		$detalleventa->precio_venta=$itemProducto->precio;

		  		$detalleventa->save();
		  		

		  	}

		 	$carrito=new  stdClass();
		 	$carrito->total=0;
		 	$carrito->productos=[];
		 	Session::put("carrito",json_encode($carrito));

		 	return view('pagos.frmConfirmacionPago');
		 }
		 else
		 {
		 	return view('pagos.frmErrorPago');
		 }

	}


	public function Confirmacionpagos()
	{

	}

}
