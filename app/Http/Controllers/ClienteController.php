<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Session;
use App\Cliente;
class ClienteController extends Controller
{
    

public function Autenticarcliente(Request $request)
	{
		$login=$request->input("txtlogin");
		$password=$request->input("txtpassword");

		$items = Cliente::where("login","=",$login)
		->where("password","=",$password)->get();

		if(count($items)>0)
		{
			Session::put("cliente",json_encode($items[0]));
			return redirect("/home");
		}
		else
		{
			return back()->withErrors(["loginerror"=>"Password y contraseña incorrectos"]);
		}
	}


/*FUNCION PARA CERRAR SECION*/
public function Cerrarsession(Request $request){
$request->session()->forget('cliente');

  
	return redirect('/home');
	}




}
