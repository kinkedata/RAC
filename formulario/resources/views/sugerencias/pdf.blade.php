<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<style>
	
	body{
	font-family: arial, sans-serif;
	font-size: 7px;
		
		
	}
	
	table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width:100%;
	font-size: 7px;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 4px;
}
thead td {
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
	</style>
	
  </head>
  <body>
      <div class="container">


	

							
<h2>Filtros de la consulta</h2>
<table class="table table-hover">
	<thead>
		<tr class="filters">
			<td width="5%">
				@if ( request()->query('cbFechaInicio') ) 
					Fecha Inicial: {{ request()->query('cbFechaInicio')  }}
				@endif
			</th>
			<td width="5%">{{ $estado->nombre }}</th>
			<td width="5%">{{ $ciudad->nombre }}</th>
			<td width="5%">{{ $tienda->nombre }}</th>
			<td width="15%">{{ request()->query('cbNombre') }}</th>
			<td width="10%">&nbsp;</th>	
			<td width="10%">&nbsp;</th>	
			<td width="10%">&nbsp;</th>	
			<td width="15%">&nbsp;</th>		
		</tr>
	</thead>
</table>
<h2>Resultados</h2>

<table class="table table-hover">
				<thead>
					<tr class="filters">
						<th width="5%">Fecha captura</th>
						<th width="5%">Estado</th>
						<th width="5%">Ciudad</th>
						<th width="5%">Tienda</th>
						<th width="15%">Nombre</th>
						<th width="10%">Celular</th>
						<th width="10%">Email</th>
						<th width="10%">Solicitud</th>
						<th width="15%">Comentarios</th>			
					</tr>				
				</thead>
				<tbody>
					@foreach ($sugerencias as $sugerencia)
					<tr>
						<td class="text-center">{{ $sugerencia->created_at->format('d/m/Y') }}</td>
						<td>
							@if ($sugerencia->estado)
								{{ $sugerencia->estado->nombre }}
							@endif
						</td>
						<td>
							@if ($sugerencia->ciudad)
								{{ $sugerencia->ciudad->nombre }}
							@endif
						</td>
						<td>
							@if ($sugerencia->tienda)
								{{ $sugerencia->tienda->nombre }}
							@endif
						</td>
						<td>{{ $sugerencia->nombre }}</td>
						<td>{{ $sugerencia->celular }}</td>
						<td>{{ $sugerencia->email }}</td>
						<td>{{ $sugerencia->solicitud }}</td>
						<td>{{ $sugerencia->comentarios }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		  
		  
		  
      </div>
  </body>
</html>