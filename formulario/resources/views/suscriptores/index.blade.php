@extends ('master')

@section ('content')

		<h5>Pop up</h5>
		
<form action="{{ action('SubscriptorsController@index') }}" method="get" name="cont-search">
		<div class="row bg-secondary p-3">
			<div class="col-3">
				<input id="cbFechaInicio" name="cbFechaInicio" value="{{ request()->query('cbFechaInicio') }}"> 
			</div>
			<div class="col-3">
				<input id="cbFechaFinal" name="cbFechaFinal" value="{{ request()->query('cbFechaFinal') }}">
			</div>
			<script>
				$("#cbFechaInicio").datepicker({
					uiLibrary: "bootstrap4",
					format: 'dd/mm/yyyy'
				});
				$("#cbFechaFinal").datepicker({
					uiLibrary: "bootstrap4",
					format: 'dd/mm/yyyy'
				});
			</script>
			<div class="col-4">
			</div> 
			<div class="col-2">
				<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
			</div>
		</div>
		<div class="row">
			<table class="table table-hover">
				<thead>
					<tr class="filters">
						<th class="text-center">Fecha captura</th>
						<th>
							<select class="form-control" name="cbSexo">
							
@if (request()->query('cbSexo') === 'Sexo')
    <option selected="selected" value="">Sexo</option>
@else
    <option value="">Sexo</option>
@endif

@if (request()->query('cbSexo') === 'H')
    <option selected="selected" value="H">Hombre</option>
@else
    <option value="H">Hombre</option>
@endif

@if (request()->query('cbSexo') === 'M')
    <option selected="selected" value="M">Mujer</option>
@else
    <option value="M">Mujer</option>
@endif							

							</select>
						</th>
						<th class=""><input type="text" class="form-control" placeholder="Correo electrónico"  name="cbCorreo" value="{{ request()->query('cbCorreo') }}"></th>
						<th>
							<select class="form-control"  name="cbStatus">

@if (request()->query('cbStatus') === 'Status')
    <option selected="selected" value="">Status</option>
@else
    <option value="">Status</option>
@endif

@if (request()->query('cbStatus') === 'Nuevo')
    <option selected="selected" value="Nuevo">Nuevo</option>
@else
    <option value="Nuevo">Nuevo</option>
@endif

@if (request()->query('cbStatus') === 'Descargado')
    <option selected="selected" value="Descargado">Descargado</option>
@else
    <option value="Descargado">Descargado</option>
@endif		

							</select>
						</th>
					</tr>
				</thead>
</form>
				<tbody>
				@foreach ($subscriptores as $subscript)
					<tr>
						<td class="text-center">{{ $subscript->created_at->format('d/m/Y') }}</td>
						<td class="text-center">{{ $subscript->genero }}</a></td>
						<td>{{ $subscript->email }}</td>
						<td class="text-center text-success">{{ $subscript->estatus }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		
		<div class="row bg-secondary p-3">
			<div class="col-10">
				<nav>
					{{ $subscriptores->appends(['cbFechaInicio' => request()->query('cbFechaInicio') ])
						->appends(['cbFechaFinal' => request()->query('cbFechaFinal') ])
						->appends(['cbSexo' => request()->query('cbSexo') ])
						->appends(['cbCorreo' => request()->query('cbCorreo') ])
						->appends(['cbStatus' => request()->query('cbStatus') ])
						->links() }}
				</nav>
			</div>
						
			<div class="col-2">
				<a href="{{ action('SubscriptorsController@exportExcel') . 
				'?cbSexo=' . request()->query('cbSexo') .
				'&cbCorreo=' . request()->query('cbCorreo') . 
				'&cbStatus=' . request()->query('cbStatus') . 
				'&cbFechaInicio=' . request()->query('cbFechaInicio') .
				'&cbFechaFinal=' . request()->query('cbFechaFinal') 
				}}" type="button" class="btn btn-primary"><i class="fas fa-download"></i> Descargar Excel</a>
			</div>
		</div>
		
		

@endsection