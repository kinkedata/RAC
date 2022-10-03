<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>POPUP</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('css/forms/css/styles-m.css') }}">
	<link rel="stylesheet" href="{{ asset('css/forms/css/styles-l.css') }}">
	<link type="text/css" rel="stylesheet" media="all" href="{{ asset('css/forms/css/global.css')}}" >
    </head>
    <body>
        
		<form action="" method="post" name="SuscriptoresForm">
		
		    {{ csrf_field() }}

			<div class="popup-gender" style="font-family: GothamMedium; color: rgb(0, 76, 142); margin: 5px 0px; font-size: 15px;">
				<input name="genero" value="H" type="radio" required /> Hombre
				<input name="genero" value="M" type="radio"> Mujer
			</div>
			<div class="popup-emal" style="margin: 5px 0px;">
				<p style="margin: 0px; font-family: GothamLight; color: rgb(0, 76, 142); font-size: 15px;">Correo electrónico</p>
				<input name="email" id="newsletter" style="background-color: rgb(222, 222, 222); font-family: GothamLight; padding: 5px 15px; border-radius: 7px;" type="email" required />
			</div>							  
			<div class="popup-action" style="margin: 5px 0px;">
				<button title="Enviar" type="submit" name="submitEnviar" id="submitEnviar" value="submitEnviar" style="background-color: rgb(0, 76, 142); border-radius: 7px; color: white; font-family: GothamMedium; font-size: 15px; padding: 5px 20px;">
					<span>Enviar</span>
				</button>
			</div>

		</form>

    </body>
</html>
