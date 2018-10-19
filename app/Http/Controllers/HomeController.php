<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
class HomeController extends Controller
{
   public function Welcome()
	{
	
		return view('hello');
	
	}
	public function Index()
	{
	
	$lista_productos=Producto::all();
  return view('home')->with('lista_productos',$lista_productos);
	
	}
}
