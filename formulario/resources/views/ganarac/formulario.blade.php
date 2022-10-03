<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Gana RAC</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('css/forms/css/styles-m.css') }}">
	<link rel="stylesheet" href="{{ asset('css/forms/css/styles-l.css') }}">
	<link type="text/css" rel="stylesheet" media="all" href="{{ asset('css/forms/css/global.css') }}">

	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

    </head>
    <body>
        
		
<form action="" method="post" name="ganaracForm">

{{ csrf_field() }}

	<div class="form-items">

		<div class="form-control">
			<label for="contrato">Contrato RAC</label>
			<input name="contrato" id="contrato" type="text" required />
		</div>
		<div class="form-control">
			<label for="nombre">Nombres</label>
			<input type="text" id="fnombre" name="fnombre" required/>
		</div>
		<div class="form-control"><label for="nombre">Apellido Paterno</label> <input id="fpaterno" name="fpaterno" type="text" required/></div>
		<div class="form-control"><label for="nombre">Apellido Materno</label> <input id="fmaterno" name="fmaterno" type="text" /></div>
		<input id="nombre-completo" type="hidden" name="nombre" />
		<div class="form-control">
			<label for="celular">Teléfono celular</label>
			<input name="celular" id="celular" type="tel" required />
		</div>
		<div class="form-control">
			<label for="email">Correo electrónico</label>
			<input name="email" id="email" type="email" required />
		</div>
		<div class="form-control">
			<label for="codigo_gana_rac">Código Gana RAC</label>
			<input name="codigo_gana_rac" id="codigo_gana_rac" type="text" required />
		</div>

		<div class="form-control">
			<input id="faviso" name="faviso" type="checkbox">
			<a href="#" data-toggle="modal" data-target="#modalAvisoIntegral">Aviso de Privacidad Integral</a>
			<button type="submit" name="submitEnviar" id="submitEnviar" value="submitEnviar">Enviar</button>
		</div>

	</div>
	
</form>
		
<script type="text/javascript">
	$(function() {
		$('#submitEnviar').click(function () {
			var nombre_completo = $('#fnombre').val() + ' ' + $('#fpaterno').val() + ' ' + $('#fmaterno').val();
			$('#nombre-completo').val(nombre_completo);
		});
	});
</script>
    </body>
</html>
