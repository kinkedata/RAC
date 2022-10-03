@extends ('master')

@section ('content')

		<h5>Gana RAC</h5>
		
<form action="{{ action('GanaRacController@index') }}" method="get" name="cont-search">
		
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
						<th class=""><input type="text" class="form-control" id="cbContrato" name="cbContrato" placeholder="Contrato RAC" value="{{ request()->query('cbContrato') }}"></th>
						<th class=""><input type="text" class="form-control" id="cbNombre" name="cbNombre" placeholder="Nombre" value="{{ request()->query('cbNombre') }}"></th>
						<th class=""><input type="text" class="form-control" id="cbTelefono" name="cbTelefono" placeholder="Teléfono Celular" value="{{ request()->query('cbTelefono') }}"></th>
						<th class=""><input type="text" class="form-control" id="cbCorreo" name="cbCorreo" placeholder="Correo electrónico" value="{{ request()->query('cbCorreo') }}"></th>
						<th class=""><input type="text" class="form-control" id="cbCodigo" name="cbCodigo" placeholder="Código de Gana RAC" value="{{ request()->query('cbCodigo') }}"></th>
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
				<tbody>
				   @foreach ($ganarac as $gana)
					<tr>
						<td class="text-center">{{ $gana->created_at->format('d/m/Y') }}</td>
						<td class="text-center">{{ $gana->contrato }}</td>
						<td>{{ $gana->nombre }}</td>
						<td class="text-center">{{ $gana->celular }}</td>
						<td>{{ $gana->email }}</td>
						<td class="text-center">{{ $gana->codigo_gana_rac }}</a></td>
						<td class="text-center text-success">{{ $gana->estatus }}</td>
					</tr>
					@endforeach
					
				</tbody>
			</table>
		</div>
</form>
		<div class="row bg-secondary p-3">
			<div class="col-10">
				<nav> 
					{{ $ganarac->appends(['cbFechaInicio' => request()->query('cbFechaInicio') ])
						->appends(['cbFechaFinal' => request()->query('cbFechaFinal') ])
						->appends(['cbContrato' => request()->query('cbContrato') ])
						->appends(['cbNombre' => request()->query('cbNombre') ])
						->appends(['cbTelefono' => request()->query('cbTelefono') ])
						->appends(['cbCorreo' => request()->query('cbCorreo') ])
						->appends(['cbCodigo' => request()->query('cbCodigo') ])
						->appends(['cbStatus' => request()->query('cbStatus') ])
						->links() }}
						
				</nav>
			</div>
			<div class="col-2">
				<a href="{{ action('GanaRacController@exportExcel') . 
				'?cbContrato=' . request()->query('cbContrato') .
				'&cbNombre=' . request()->query('cbNombre') . 
				'&cbTelefono=' . request()->query('cbTelefono') . 
				'&cbCorreo=' . request()->query('cbCorreo') . 
				'&cbCodigo=' . request()->query('cbCodigo') . 
				'&cbStatus=' . request()->query('cbStatus') . 
				'&cbFechaInicio=' . request()->query('cbFechaInicio') .
				'&cbFechaFinal=' . request()->query('cbFechaFinal') 
				}}" type="button" class="btn btn-primary"><i class="fas fa-download"></i> Descargar Excel</a>
			</div>
		</div>

@endsection