<!doctype html>
<html lang="en">
<head>
  
	<!-- meta tags -->
	<meta charset="utf-8">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/vendor/personalizado/personalizados1.css') }}">
	<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.1/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	
	<!-- Bootstrap JS -->
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.1/combined/js/gijgo.min.js" type="text/javascript"></script>
	
	<!-- Icons -->
	<script defer src="{{ asset('/fonts/fontawesome-free-5.0.8/svg-with-js/js/fontawesome-all.min.js') }}"></script>

	<!-- app css -->
	<link rel="stylesheet" href="{{ asset('css/global.css') }}">

	<!-- app js -->
	<script>
	var myFullUrl = "{{ url('') }}";
	</script>
	<script src="{{ asset('/js/global.js') }}"></script>
	
	<title>{{ $title }}</title>

</head>
<body>
    
	<div class="container">	
		<div class="row">
			<div class="btn-group col-10 p-3">

				@include('parts.menu')
					
			</div>
			<div class="col-2">
				<a href="{{ url('/logout') }}" type="button" class="btn btn-primary my-3 pr-3">Salir</a>
			</div>
		</div>
		
		@yield('content')


	</div>
</body>
</html>
