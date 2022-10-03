@extends ('master')

@section ('content')

		<h5>Solicita informes</h5>
                
<form action="{{ action('ContactosController@index') }}" method="get" name="cont-search">
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
						<th><input type="text" class="form-control" placeholder="Nombre" name="cbNombre" value="{{ request()->query('cbNombre') }}"></th>
						<th>
							<select class="form-control" id="cbEstados" name="cbEstados">
								<option value="" default>Estado</option>
							@foreach($estados as $item)
							        @if ($item->id == request()->query('cbEstados') )
										<option value="{{ $item->id }}" selected="selected">{{ $item->nombre }}</option>
									@else
										<option value="{{ $item->id }}">{{ $item->nombre }}</option>
									@endif
							@endforeach
							</select>
						</th>
						<th>
							<input type="hidden" id="cbCiudades_initial" value="{{ request()->query('cbCiudades') }}">
							<select class="form-control" id="cbCiudades" name="cbCiudades">
								<option value="">Ciudad</option>
							</select>
						</th>
						<th>
							<input type="hidden" id="cbTiendas_initial" value="{{ request()->query('cbTiendas') }}">
							<select class="form-control" id="cbTiendas" name="cbTiendas">
								<option value="">Tienda RAC</option>
							</select>
						</th>
						<th class="text-center">Fecha modificación</th>
						<th class="text-center align-middle">Status</th>						
					</tr>
				</thead>
</form>
				<tbody>
					@foreach ($contactos as $contacto)
					<tr>
						<td class="text-center">{{ $contacto->created_at->format('d/m/Y') }}</td>
						<td><a href="contactos/{{ $contacto->id }}">{{ $contacto->nombre }}</a></td>
						<td>
							@if ($contacto->estado)
								{{ $contacto->estado->nombre }}
							@endif
						</td>
						<td>
							@if ($contacto->ciudad)
								{{ $contacto->ciudad->nombre }}
							@endif
						</td>
						<td>
							@if ($contacto->tienda)
								{{ $contacto->tienda->nombre }}
							@endif
						</td>
						<td class="text-center">{{ $contacto->updated_at->format('d/m/Y') }}</td>
						<td class="text-center">
							@switch($contacto->status->nombre)
								@case('Nuevo')
									<i class="far fa-check-circle"></i>
									@break
								@case('Abierto')
									<i class="fas fa-check-circle" style="color:sandybrown"></i>
									@break
								@case('Cerrado')
									<i class="fas fa-check-circle" style="color:green">
									@break
							@endswitch
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="row bg-secondary p-3">
			<div class="col-8">
				<nav>
					{{ $contactos->appends(['cbFechaInicio' => request()->query('cbFechaInicio') ])
						->appends(['cbFechaFinal' => request()->query('cbFechaFinal') ])
						->appends(['cbNombre' => request()->query('cbNombre') ])
						->appends(['cbEstados' => request()->query('cbEstados') ])
						->appends(['cbCiudades' => request()->query('cbCiudades') ])
						->appends(['cbTiendas' => request()->query('cbTiendas') ] )->links() }}
				</nav>
			</div>
                        
			<div class="col-2">
				<a href="{{ action('ContactosController@exportContactos') . 
				'?cbNombre=' . request()->query('cbNombre') .
				'&cbEstados=' . request()->query('cbEstados') . 
				'&cbCiudades=' . request()->query('cbCiudades') . 
				'&cbTiendas=' . request()->query('cbTiendas') .
				'&cbFechaInicio=' . request()->query('cbFechaInicio') .
				'&cbFechaFinal=' . request()->query('cbFechaFinal') 
				}}" type="button" class="btn btn-primary"><i class="fas fa-download"></i> Descargar Excel</a>
			</div>
			<div class="col-2">
				<a href="{{ action('ContactosController@downloadPDF') . 
				'?cbNombre=' . request()->query('cbNombre') .
				'&cbEstados=' . request()->query('cbEstados') . 
				'&cbCiudades=' . request()->query('cbCiudades') . 
				'&cbTiendas=' . request()->query('cbTiendas') .
				'&cbFechaInicio=' . request()->query('cbFechaInicio') .
				'&cbFechaFinal=' . request()->query('cbFechaFinal') 
				}}" type="button" class="btn btn-primary"><i class="fas fa-download"></i> Descargar PDF</a>
			</div>
		</div>

@endsection