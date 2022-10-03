@extends ('master')

@section ('content')
<form action="" method="post" name="sugerenciadetalle">
{{ csrf_field() }}
		<div class="row col-7">
			<table class="table table-hover">
				<thead>
					<tr class="filters">
						<th colspan="3" class=""><h5>Sugerencias, dudas o aclaraciones - Detalle</h5></th>					
					</tr>
				</thead>
				<tbody>
					<tr class="">
						<td>Nombre</td>
						<td colspan="2"><input type="text" name="nombre" class="form-control" value="{{ $sugerencia->nombre }}" required></td>
					</tr>
					<tr class="">
						<td>Teléfono Celular</td>
						<td colspan="2"><input type="text" name="celular" class="form-control" value="{{ $sugerencia->celular }}" required></td>
					</tr>
					<tr class="">
						<td>Correo electrónico</td>
						<td colspan="2"><input type="text" name="email" class="form-control" value="{{ $sugerencia->email }}" required></td>
					</tr>
					<tr>
						<td>Solicitud</td>
						<td colspan="2">
							<select class="form-control" name="solicitud" id="solicitud" required>
								<option default>Sugerencia</option>
								@if ($sugerencia->solicitud == 'Duda')
									<option selected="selected">Duda</option>
								@else
									<option>Duda</option>
								@endif
								@if ($sugerencia->solicitud == 'Aclaración')
									<option selected="selected">Aclaración</option>
								@else
									<option>Aclaración</option>
								@endif
							</select>
						</td>
					</tr>
					<tr class="">
						<td>Comentarios</td>
						<td colspan="2"><textarea name="comentarios" class="form-control" rows="5" required>{{ $sugerencia->comentarios }}</textarea>
					</tr>
					<tr class="">
						<td>Estado</td>
						<td colspan="2">
							<select class="form-control" name="estado_id" id="cbEstados" required>
								@empty ($sugerencia->estado)
									<option value="" selected="selected" default>--</option>
								@endempty
								@foreach($estados as $estado)
									@if ($estado->id == $sugerencia->estado_id)
										<option value="{{ $estado->id }}" selected="selected">{{ $estado->nombre }}</option>
									@else
										<option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
									@endif
								@endforeach
							</select>
						</td>
					</tr>
					<tr class="">
						<td>Ciudad</td>
						<td colspan="2">
							<input type="hidden" id="cbCiudades_initial" value="{{ $sugerencia->ciudad_id }}">
							<select class="form-control" name="ciudad_id" id="cbCiudades" required>
								<option value="">Ciudad</option>
							</select>
						</td>
					</tr>
					<tr class="">
						<td>Tienda RAC</td>
						<td colspan="2">
							<input type="hidden" id="cbTiendas_initial" value="{{ $sugerencia->tienda_id }}">
							<select class="form-control" name="tienda_id" id="cbTiendas" required>
								<option value="">Tienda RAC</option>
							</select>
						</td>
					</tr>
					<tr class="">
						<td>Estatus</td>
						<td colspan="2">
							<select name="status_id" class="form-control" required>
								@foreach($statuses as $statuss)
									@if ($statuss->id == $sugerencia->status->id)
										<option value="{{ $statuss->id }}" selected="selected">{{ $statuss->nombre }}</option>
									@else
										<option value="{{ $statuss->id }}">{{ $statuss->nombre }}</option>
									@endif
								@endforeach
							</select>
						</td>
					</tr>
					
				</tbody>
			</table>
			
			
			<table class="table table-hover">
				<thead>
					<tr>
						<td>Agregar anotación</td>
						<td><input id="anotacion" name="anotacion" type="text" class="form-control"></td>
						<td><button id="addAnotacion" type="button" class="btn btn-primary float-right">Agregar</button></td>
					</tr>
				</thead>
				<tbody class="anotaciones">
					@foreach ($sugerencia->notas as $count => $nota)
						<tr>
							<td>{{ $count + 1 }}</td>
							<td>{{ $nota->anotacion }}</td>
							<td>{{ $nota->created_at->format('d/m/Y H:i:s') }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
		</div>
		
		<div class="row bg-secondary p-3 col-7">
			<a href="{{ action('SugerenciasController@index') }}" type="button" class="btn btn-primary col-2">Regresar</a>
			<div class="col-3"></div>
			<button type="submit" class="btn btn-primary col-4" name="submitNoReturn" id="submitNoReturn" value="submitNoReturn" >Guardar y continuar</button>
			<div class="col-1"></div>
			<button type="submit" class="btn btn-primary col-2" name="submitNoReturn" id="submitNoReturn" value="submitYesReturn">Guardar</button>
		</div>
		
</form>
@endsection
