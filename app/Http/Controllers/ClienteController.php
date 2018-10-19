<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    

public function postAutenticarcliente()
	{
		$login=Input::get("txtlogin");
		$password=Input::get("txtpassword");

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
public function getCerrarsession(){
	Session::forget("cliente");
	
	return back();
	}




}
