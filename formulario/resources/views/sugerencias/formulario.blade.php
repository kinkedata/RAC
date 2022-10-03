<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Informes</title>
		
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

	<script>
	var myFullUrl = "{{ url('') }}";
	</script>
	<script src="{{ asset('/js/global.js') }}"></script>
	
		
	<link rel="stylesheet" href="{{ asset('css/forms/css/styles-m.css') }}">
	<link rel="stylesheet" href="{{ asset('css/forms/css/styles-l.css') }}">
	<link type="text/css" rel="stylesheet" media="all" href="{{ asset('css/forms/css/global.css') }}">
		
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
<form action="" method="post" name="ganaracForm">

	{{ csrf_field() }}
	
	<div class="form-items">
		<div class="form-control">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" id="nombre" required />
		</div>
		<div class="form-control">
			<label for="celular">Celular</label>
			<input type="tel" name="celular" id="celular" required />
		</div>
		<div class="form-control">
			<label for="email">E-mail</label>
			<input type="email" name="email" id="email" required />
		</div>
		<div class="form-control">
			<label for="estado_id">Estado</label>
			<select class="form-control" name="estado_id" id="cbEstados" required>
				<option value="" selected="selected" default>--</option>
				@foreach($estados as $estado)
					<option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-control">
			<label for="ciudad_id">Ciudad</label>
			<input type="hidden" id="cbCiudades_initial" value="0">
			<select class="form-control" name="ciudad_id" id="cbCiudades" required>
					<option value="">Ciudad</option>
			</select>
		</div>
		<div class="form-control">
			<label for="tienda_id">Tienda</label>
			<input type="hidden" id="cbTiendas_initial" value="0">
			<select class="form-control" name="tienda_id" id="cbTiendas" required>
					<option value="">Tienda RAC</option>
			</select>
		</div>
		<div class="form-control">
			<div class="form-control">
						<label for="solicitud"><span>Selecciona una opción</span></label>
				<div class="radio-item">
						<input name="solicitud" value="Sugerencia" required="" type="radio"> Sugerencia
				</div>
				<div class="radio-item">
						<input name="solicitud" value="Duda" type="radio"> Duda
				</div>
				<div class="radio-item">
						<input name="solicitud" value="Duda" type="radio"> Aclaración
				</div>
			</div>
		</div>
		<div class="form-control">
			<label for="comentarios">Comentarios</label>
			<textarea name="comentarios" rows="4" cols="25"></textarea>
		</div>
		<div class="form-control right">
			<input id="faviso" name="faviso" type="checkbox">
			<a href="#" data-toggle="modal" data-target="#modalAvisoIntegral">Aviso de Privacidad Integral</a>
			<button type="submit" name="submitEnviar" id="submitEnviar" value="submitEnviar">Enviar</button>
		</div>
	</div>
	
</form>



    </body>
</html>
