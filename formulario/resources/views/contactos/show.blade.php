@extends ('master')

@section ('content')
<form action="" method="post" name="contactodetalle" id="contactodetalle">
{{ csrf_field() }}
		<div class="row col-7">

			<table class="table table-hover">
				<thead>
					<tr class="filters">
						<th colspan="3" class=""><h5>Solicita informes - Detalle</h5></th>					
					</tr>
				</thead>
				<tbody>
					<tr class="">
						<td>Nombre</td>
						<td colspan="2">
							<input name="nombre" type="text" class="form-control" value="{{ $contacto->nombre }}" required>
						</td>
					</tr>
					<tr class="">
						<td>Teléfono Fijo</td>
						<td colspan="2">
							<input name="telefono" type="text" class="form-control" value="{{ $contacto->telefono }}" required>
						</td>
					</tr>
					<tr class="">
						<td>Teléfono Celular</td>
						<td colspan="2">
							<input name="celular" type="text" class="form-control" value="{{ $contacto->celular }}" required>
						</td>
					</tr>
					<tr class="">
						<td>Estado</td>
						<td colspan="2">
							<select class="form-control" name="estado_id" id="cbEstados" required>
								@empty ($contacto->estado)
									<option value="" selected="selected" default>--</option>
								@endempty
								@foreach($estados as $estado)
									@if ($estado->id == $contacto->estado_id)
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
							<input type="hidden" id="cbCiudades_initial" value="{{ $contacto->ciudad_id }}">
							<select class="form-control" name="ciudad_id" id="cbCiudades" required>
								<option value="">Ciudad</option>
							</select>
						</td>
					</tr>
					<tr class="">
						<td>Tienda RAC</td>
						<td colspan="2">
							<input type="hidden" id="cbTiendas_initial" value="{{ $contacto->tienda_id }}">
							<select class="form-control" name="tienda_id" id="cbTiendas" required>
								<option value="">Tienda RAC</option>
							</select>
						</td>
					</tr>
					<tr class="">
						<td>Producto de interés</td>
						<td colspan="2">
							<input name="producto" type="text" class="form-control" value="{{ $contacto->producto }}" readonly="readonly">
						</td>
					</tr>
					<tr class="">
						<td>Correo electrónico</td>
						<td colspan="2">
							<input name="email" type="text" class="form-control" value="{{ $contacto->email }}" required>
						</td>
					</tr>
					<tr class="">
						<td>Estatus</td>
						<td colspan="2">
							<select name="status_id" class="form-control" required>
								@foreach($statuses as $status)
									@if ($status->id == $contacto->status_id)
										<option value="{{ $status->id }}" selected="selected">{{ $status->nombre }}</option>
									@else
										<option value="{{ $status->id }}">{{ $status->nombre }}</option>
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
					@foreach ($contacto->notas as $count => $nota)
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
			<a href="{{ action('ContactosController@index') }}" type="button" class="btn btn-primary col-2">Regresar</a>
			<div class="col-3"></div>
			<button type="submit" class="btn btn-primary col-4" name="submitNoReturn" id="submitNoReturn" value="submitNoReturn" >Guardar y continuar</button>
			<div class="col-1"></div>
			<button type="submit" class="btn btn-primary col-2" name="submitNoReturn" id="submitNoReturn" value="submitYesReturn">Guardar</button>
		</div>
</form>
@endsection
