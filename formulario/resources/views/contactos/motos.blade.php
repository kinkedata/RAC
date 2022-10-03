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
		.motos-formulario {
			display: flex;
			justify-content: space-between;
		}
		.estados-cont {
			margin-right: 1rem;
		}
		.estados-list {
			list-style-type: none;
			padding: 0px;
			margin: 0px;
		}
		.estados-list li {
			font-size: 18px;
			font-weight: 700;
			line-height: 21px;
			color: #555555;
			margin: 1rem 0px;
		}
		h2 {
			border-bottom: none !important;
			font-size: 32px;
		}
		.main {
			position: relative;
		}

		.formulario-crm-rac {
			position: relative;
			height: auto;
			text-align: left;
			max-width: 700px;
			margin: 0px;
		}

		form#solicita-informes-form {
			width: auto !important;
			top: 0;
			position: relative;
			background: #c4c4c4;
			border-radius: 4px;
		}

		form#solicita-informes-form .solicita-informes-send {
			float: none;
		}

		@media only screen and (max-width: 769px) {
			.motos-formulario {
				flex-direction: column;
			}
			.estados-cont {
				margin: 1rem 0px;
				display: table;
				text-align: center;
			}

			.estados-list {
				display: table;
				margin: auto;
			}
		}
	</style>
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
	<script>var myFullUrl = "{{ url('') }}";</script>
	<script src="{{ asset('/js/global.js?version=3') }}"></script>
		<!-- Hotjar Tracking Code for https://formulario.rac.mx/formularios/contacto -->
		<script>
			(function (h, o, t, j, a, r) {
				h.hj =
					h.hj ||
					function () {
						(h.hj.q = h.hj.q || []).push(arguments);
					};
				h._hjSettings = { hjid: 2129978, hjsv: 6 };
				a = o.getElementsByTagName("head")[0];
				r = o.createElement("script");
				r.async = 1;
				r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
				a.appendChild(r);
			})(window, document, "https://static.hotjar.com/c/hotjar-", ".js?sv=");
		</script>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		<main id="maincontent" class="page-main container">
			<form id="solicita-informes-form" action="" method="post" name="ganaracForm">
				{{ csrf_field() }}
				<div class="solicita-informes-form-item half first">
					<label for="nombre">Primer nombre</label>
					<input type="text" id="nombre" name="nombre" required />
				</div>
	<div class="solicita-informes-form-item half second">
					<label for="segundo_nombre">Segundo nombre</label>
					<input type="text" id="segundo_nombre" name="segundo_nombre" required />
				</div>
	<div class="solicita-informes-form-item half first">
		<label for="a_paterno">Apellido paterno</label>
		<input type="text" id="a_paterno" name="a_paterno" required />
	</div>
	<div class="solicita-informes-form-item half second">
		<label for="a_materno">Apellido materno</label>
		<input type="text" id="a_materno" name="a_materno" required />
	</div>
				<div class="solicita-informes-form-item half first">
					<label for="phone">Telefono de contacto</label>
					<input id="phone type="text" name="telefono" required>
				</div>
	<div class="solicita-informes-form-item half second">
		<label for="celular">Teléfono celular</label>
		<input id="celular" type="text" name="celular" required>
	</div>
				<div class="solicita-informes-form-item half first">
					<label for="horario_preferente">Horario de contacto preferente</label>
					<select class="form-control" name="horario_preferente" id="horario_preferente" required>
						<option value="" default>--</option>
						@foreach($horarios as $horario)
						<option value="{{$horario['value']}}">{{$horario['text']}}</option>
						@endforeach
					</select>
				</div>
				<div class="solicita-informes-form-item half second">
					<label for="fproducto">Producto de interes</label>
					<select id="fproducto" name="producto">
						<option value="">--</option>
						<option value="DT150 Sport">DT150 Sport</option>
						<option value="125Z">125Z</option>
						<!--option value="DT150CLAS">DT150 Clasica</option>
						<option value="X150">X150</option-->
					</select>
				</div>
				<div class="solicita-informes-form-item half first">
					<label for="nombre">Estado</label>
					<select class="form-control" name="estado_id" id="cbEstados" required>
						<option value="" default>--</option>
						@foreach($estados as $estado)
						<option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
						@endforeach
					</select>
				</div>
				<div class="solicita-informes-form-item half second">
					<label for="nombre">Ciudad</label>
					<select
						class="form-control"
						name="ciudad_id"
						id="cbCiudades"
						required
					>
						<option value="">Ciudad</option>
					</select>
				</div>
				<div class="solicita-informes-form-item half first">
					<label for="nombre">Tienda</label>
					<select class="form-control" name="tienda_id" id="cbTiendas" required>
						<option value="">Tienda RAC</option>
					</select>
				</div>
				<!--div id="map"></div-->
				<div class="solicita-informes-form-item" style="clear: both; display: none;">
					<label for="email">E-mail</label>
					<input type="text" name="email" id="email" value="NULL" required/>
				</div>
				<div
					class="solicita-informes-form-item"
					style="
						display: flex;
						justify-content: center;
						align-items: center;
						margin: 1.5rem 0px;
					"
				>
					<input
						id="faviso"
						style="width: 5%; margin: 0px"
						name="faviso"
						type="checkbox"
					/><a href="#" data-toggle="modal" data-target="#modalAvisoIntegral"
						>Aviso de Privacidad Integral</a
					>
				</div>
				<div class="solicita-informes-form-item">
					<button onclick="dataLayer.push({'event': 'solicita_informacion'});" type="submit" name="submitEnviar" id="submitEnviar" value="submitEnviar" class="solicita-informes-send">Enviar</button>
				</div>
			</form>
		</main>
	</body>
</html>

