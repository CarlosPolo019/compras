@extends('templates.maestroinicio')

@section('body')

<!--Con base de datos-->

	<div class="row">

			<center>
				<?php
					foreach ($lista_productos as $producto) {				
				?>
				<div  class="col-sm-4" style="padding: 10px">
				    <img src="{{asset($producto->ruta_imagen)}}" class="img-thumbnail" style=" width: 150px;">
					<h4>{{$producto->nombre}}</h4>
					<p>{{$producto->descripcion}}</p>
					<H3>COP/. <?=$producto->precio?></H3>
					<a class="btn btn-primary" href=" {{route('AgregarCarrito', ['id' => $producto->id,'cant' => 1 ])}}">comprar</a>
				</div>

				<?php
					}
				?>
			</center>
		
	</div>

@stop