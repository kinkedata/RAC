<?php
function readCSV($csvFile){

    $file_handle = fopen($csvFile, 'r');

    while (!feof($file_handle) ):

        $line_of_text[] = fgetcsv($file_handle, 1024);

    endwhile;

    fclose($file_handle);

    return $line_of_text;
}

function getTiendas(){

	$tiendas = readCSV('sucursales.txt');
	$output  = array();

	foreach($tiendas as $tienda):

		$set = array(
			'titulo'    => $tienda[1],
			'horario'   => $tienda[4] . '<br>' . $tienda[5],
			'direccion' => $tienda[6],
			'telefono'  => $tienda[7],
			'data' 		=> array(
				'lat' => $tienda[8],
				'lng' => $tienda[9]
			)
		);

		array_push($output, $set);

	endforeach;

	return $output;
}

function getTiendaByCiudadyEstado($cidudad, $estado) {
	$tiendas = readCSV('sucursales.txt');
	$output  = array();
        
        $ciudad = trim($cidudad);
        $estado = trim($estado);

	foreach($tiendas as $tienda):
            if(($tienda[2] == $cidudad) && ($tienda[3] == $estado)) {
		$set = array(
			'titulo'    => $tienda[1],
                        'ciudad' => $tienda[2],
                        'estado' => $tienda[3],
			'horario'   => $tienda[4] . '<br>' . $tienda[5],
			'direccion' => $tienda[6],
			'telefono'  => $tienda[7],
			'data' 		=> array(
				'lat' => $tienda[8],
				'lng' => $tienda[9]
			)
		);

		array_push($output, $set);
            } else {

            }

	endforeach;

	return $output;
}


function getDefaultTiendas() {
	$tiendas = readCSV('sucursales.txt');
	$output  = array();

	foreach($tiendas as $tienda):

            $set = array(
                    'titulo'    => $tienda[1],
                    'ciudad' => $tienda[2],
                    'estado' => $tienda[3],
                    'horario'   => $tienda[4] . '<br>' . $tienda[5],
                    'direccion' => $tienda[6],
                    'telefono'  => $tienda[7],
                    'data' 		=> array(
                            'lat' => $tienda[8],
                            'lng' => $tienda[9]
                    )
            );

            array_push($output, $set);

	endforeach;

	return $output;
}

function getCoord($address){

	/*
	**
		Added Search capability using google api geocode for addresses
		@since 1.0.4
	**
	*/
	if(isset($address)):

		$address         = urlencode($address);
		$details         = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . $address));
		$city            = explode(",", $details->results[0]->formatted_address);

		$output['lat']   = $details->results[0]->geometry->location->lat;
		$output['lng']   = $details->results[0]->geometry->location->lng;
		$output['city']  = $city[0];

	endif;

	return $output;
}

function calculateDist($lat1, $lon1, $lat2, $lon2, $unit){

	$theta = $lon1 - $lon2;
	$dist  = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist  = acos($dist);
	$dist  = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit  = strtoupper($unit);

	if ($unit == "K"):
		return ($miles * 1.609344);
	elseif ($unit == "N"):
		return ($miles * 0.8684);
	else:
		return $miles;
	endif;
}

function getStoreDistances($direccion){

	$tiendas    = getTiendas();
	$referencia = getCoord($direccion);
	$output['tiendas'] = array();

	foreach ($tiendas as $tienda):

		$tienda['distancia'] = calculateDist($referencia['lat'], $referencia['lng'], $tienda['data']['lat'], $tienda['data']['lng'], 'KM');

		array_push($output['tiendas'], $tienda);

	endforeach;

	/*
	**
		Order Results by Distance
		@since 1.0.0
	**
	*/
	$sort_array = array();

	foreach($output['tiendas'] as $tienda):

	    foreach($tienda as $key=>$value):

	        if(!isset($sort_array[$key])):
	            $sort_array[$key] = array();
	        endif;

        	$sort_array[$key][] = $value;

	    endforeach;
	endforeach;

	$orderby = 'distancia';

	array_multisort($sort_array[$orderby], SORT_ASC, $output['tiendas']);

	$output['Query']   = $_GET;
	$output['usuario'] = $referencia;

	return $output;
}

header('Content-Type: application/json');

if(isset($_GET['ciudad'])) {
    echo json_encode(getTiendaByCiudadyEstado($_GET['ciudad'], $_GET['estado']));
} else {
    echo json_encode(getDefaultTiendas());
}
