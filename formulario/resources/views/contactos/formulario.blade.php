<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
	<title>Informes</title>
	
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NCBKTT3');</script>
<!-- End Google Tag Manager -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_zipNjYm7FAd5lbcAcX4fqqUaIzhtXe0"></script>
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/forms/css/styles-l.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/forms/css/styles-m.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/forms/css/global.css') }}" />
<style>
label{
	display: inline-block;
}
#map{
	clear: both;
	height: 180px;
	display: none;
}
#motosAdvice{
	display:none;
}
#motosAdvice p{
	font-size: 10px;
}
</style>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script>var myFullUrl = "{{ url('') }}";</script>
<script src="{{ asset('/js/global.js?version=4') }}"></script>
<!-- Hotjar Tracking Code for https://formulario.rac.mx/formularios/contacto -->
<script>
	(function(h,o,t,j,a,r){
		h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
		h._hjSettings={hjid:2129978,hjsv:6};
		a=o.getElementsByTagName('head')[0];
		r=o.createElement('script');r.async=1;
		r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
		a.appendChild(r);
	})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>			
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NCBKTT3" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<main id="maincontent" class="page-main container">

		<form id="solicita-informes-form" action="" method="post" name="ganaracForm">
			{{ csrf_field() }}

			<h1>SOLICITA INFORMES</h1>
			<p style="font-size:14px;text-align:center;">Regístrate y nosotros te llamamos</p>

			<div class="solicita-informes-form-item">
				<label for="nombre">Nombre *</label><input type="text" id="nombre" name="nombre" required/>
			</div>
			<div class="solicita-informes-form-item">
				<label for="nombre">Segundo nombre</label><input type="text" id="segundo_nombre" name="segundo_nombre"/>
			</div>
			<div class="solicita-informes-form-item half first">
				<label for="nombre">Apellido Paterno *</label> <input id="a_paterno" name="a_paterno" type="text" required/>
			</div>
			<div class="solicita-informes-form-item half second">
				<label for="nombre">Apellido Materno *</label> <input id="a_materno" name="a_materno" type="text" required/>
			</div>
			<!-- <input id="nombre-completo" type="hidden" name="nombre" /> -->
			<div class="solicita-informes-form-item">
				<input type="text" id="telefono" value="5555555555" maxlength="10" minlength="10" name="telefono" hidden placeholder="Ingresa tu número a 10 dígitos" required/>
			</div>
			<div class="solicita-informes-form-item">
				<label for="nombre">Telefono Celular *</label> <input type="text" id="celular" maxlength="10" minlength="10" name="celular" placeholder="Ingresa tu número a 10 dígitos" required/>
			</div>
			<div class="solicita-informes-form-item">
				<label for="horario_preferente">Horario de contacto preferente *</label>
				<select class="form-control" name="horario_preferente" id="horario_preferente" required>
					<option value="" default>--</option>
					@foreach($horarios as $horario)
					<option value="{{$horario['value']}}">{{$horario['text']}}</option>
					@endforeach
				</select>
			</div>	
			<div class="solicita-informes-form-item">
				<label for="nombre">Producto de interés *</label>
				<select id="fproducto" name="producto" required>
					<option value="">--</option>
					<option value="Celulares">Celulares</option>
					<option value="Computadoras">Computadoras</option>
					<option value="Electrónicos">Electrónicos</option>
					<option value="Línea Blanca">Línea Blanca</option>
					<option value="Muebles">Muebles</option>
					<option value="Motos">Motos</option>
				</select>
			</div>
			<div id="motosAdvice" class="solicita-informes-form-item">
				<p>Las motos sólo están disponibles en algunas sucursales. Selecciona la más cercana a tu ubicación.</p>	
			</div>
			<div class="solicita-informes-form-item">
				<label for="nombre">Estado *</label>
				<select class="form-control" name="estado_id" id="cbEstados" required>
					<option value="" default>--</option>
					@foreach($estados as $estado)
					<option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
					@endforeach
				</select>
			</div>
			<div class="solicita-informes-form-item half first">
				<label for="nombre">Ciudad *</label>
				<!--input type="hidden" id="cbCiudades_initial" value="00"-->
				<select class="form-control" name="ciudad_id" id="cbCiudades" required>
					<option value="" selected>Ciudad</option>
				</select>
			</div>
			<div class="solicita-informes-form-item half second">
				<label for="nombre">Tienda *</label>
				<!--input type="hidden" id="cbTiendas_initial" value="0"-->
				<select class="form-control" name="tienda_id" id="cbTiendas" required>
					<option value="" selected>Tienda RAC</option>
				</select>
			</div>
			<div id="map"></div>
			<div class="solicita-informes-form-item" style="clear: both; display: none;">
				<label for="email">E-mail *</label>
				<input type="text" name="email" id="email" value="NULL" required/>
			</div>
			<div class="solicita-informes-form-item" style="display: inline-block;"><input id="faviso" style="width: 10%;" name="faviso" type="checkbox" /><a href="#" data-toggle="modal" data-target="#modalAvisoIntegral">Manifiesto que leí, conozco y estoy de acuerdo con el aviso de privacidad</a></div>
			<div class="solicita-informes-form-item">
				<button onclick="dataLayer.push({'event': 'solicita_informacion'});" type="submit" name="submitEnviar" id="submitEnviar" value="submitEnviar" class="solicita-informes-send">Enviar</button>
			</div>
		</form>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script type="text/javascript">
			$('#solicita-informes-form').validate({
				rules: {
					nombre: { required: true },
					a_paterno: { required: true },
					a_materno: { required: true },
					telefono: { required: true, number: true, minlength: 10, maxlength: 10 },
					celular: { required: true, number: true, minlength: 10, maxlength: 10 },
					horario_preferente: { required: true },
					producto: { required: true },
					estado_id: { required: true },
					ciudad_id: { required: true },
					tienda_id: { required: true },
				}, messages: {
					nombre: "Por favor ingresa tu Nombre",
					a_paterno: "Por favor ingresa tu Apellido Paterno",
					a_materno: "Por favor ingresa tu Apellido Materno",
					telefono: "Por favor escribe el teléfono a 10 dígitos",
					celular: "Por favor escribe el teléfono a 10 dígitos",
					horario_preferente: "Por favor seleccione un horario",
					producto: "Por favor seleccione un producto",
					estado_id: "Por favor seleccione un estado",
					ciudad_id: "Por favor seleccione una ciudad",
					tienda_id: "Por favor seleccione una tienda",
				}, submitHandler: function(form){
					$(form).submit();
				}
			});

			/*$("#solicita-informes-form").on('submit', function(e){
				e.preventDefault();
				console.log($(e.target).serialize());
			});*/	
			// $(function() {
			// 	$('#submitEnviar').click(function () {
			// 		var nombre_completo = $('#fnombre').val() + ' ' + $('#fpaterno').val() + ' ' + $('#fmaterno').val();
			// 		$('#nombre-completo').val(nombre_completo);
			// 	});
			// });
		</script>
	</div>
</body>
</html>