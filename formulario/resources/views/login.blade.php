<!doctype html>
<html lang="en">
<head>
  
	<!-- meta tags -->
	<meta charset="utf-8">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ URL::asset('css/vendor/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/vendor/personalizado/personalizados1.css') }}">
	
	<title>Ingreso</title>

</head>
<body>
	<div class="container mt-5">
		<div class="card p-5 m-auto">
			<img class="card-logo mx-auto mb-3" src="{{ asset('images/rac-perfil-logo.png') }}">
			<h4 class="mx-auto mb-3">CRM</h4>
			<div class"form-group">
				<form action="{{ action('ContactosController@index') }}" method="post">
					{{ csrf_field() }}
					<input name="login_user" type="text" class="form-control mb-3" placeholder="Usuario" required autofocus>
					<input name="login_pass" type="password" id="inputContraseña" class="form-control mb-3" placeholder="Contraseña" required>
					<button type="submit" class="btn btn-primary btn-block">Ingresar</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>