@extends('templates.maestroinicio')
@section('body')
	<h1>CONFIRMACION</h1>

	<h4 style="background: green">Se realizó exitsamente la compra</h4>

	<a href="{{route('Miscompras')}}"> ver mis compras</a>
@stop