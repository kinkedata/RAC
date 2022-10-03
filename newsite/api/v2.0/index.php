<?php

	// Mostramos todos los errores de PHP
	error_reporting( 1 );
	error_reporting( E_ALL );
	ini_set( 'display_errors', 1 );

	require_once( dirname(__FILE__) . '/Config/includes.php' );

	// Modificacion de precision en serializacion para json
	ini_set( 'precision', 10 );
	ini_set( 'serialize_precision', 10 );

	/* - Obtenemos la ruta solicitada en la peticion excluyendo el dominio
	 * - Extraemos el directorio padre que contiene al directorio del API
	 * - Concatenamos el directorio padre con el directorio del API_DIR 	*/
	define( 'API_VERSION', 'v2.0' );
	define( 'REQUEST_URL', $_SERVER['PHP_SELF'] );
	define( 'PARENT_DIR', explode( '/api/' . API_VERSION, REQUEST_URL )[0] );
	define( 'CURRENT_URI', 'http' . (($_SERVER['SERVER_PORT'] == 443) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
	define( 'API_DIR', PARENT_DIR . '/api/' . API_VERSION );

	Cache::initialize();

	Route::add( 'GET', '/', function(){ 
		Rest::sendResponse(200, [ 'description' => 'OK' ]); 
	});
	Route::add( 'GET', '/info', function(){ 
		phpinfo(); 
	});

	Route::add( 'POST', '/informes', function(){
		$db = new mysqli( Config::DB_HOST, Config::DB_USERNAME, Config::DB_PASSWORD, Config::DB_NAME, Config::DB_PORT );
		
		if ($db->connect_error)
			Rest::sendResponse(500, ['description' => 'Datos de conexion invalidos']);

		$db->set_charset('utf8');
		$stmt = $db->prepare('INSERT INTO informes(nombre,segundo_nombre,apellido_paterno,apellido_materno,telefono,horario,producto,proceso,estado_id,ciudad_id,tienda_id,previous,current,product_name,product_id,zip_code) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);');
		$stmt->bind_param('sssssssiiiisssii', 
							$_POST['nombre'], 
							$_POST['segundo_nombre'], 
							$_POST['apellido_paterno'], 
							$_POST['apellido_materno'], 
							$_POST['celular'], 
							$_POST['horario'], 
							$_POST['producto'], 
							$_POST['proceso'], 
							$_POST['estado_id'], 
							$_POST['ciudad_id'], 
							$_POST['tienda_id'],
							$_POST['previous'],
							$_POST['current'],
							$_POST['producto_name'],
							$_POST['idprod'],
							$_POST['zip_code']
						);
		$stmt->execute();
		$folio = $stmt->insert_id;
		Rest::sendResponse(200, ['description' => true, 'folio' => $folio]);
	});

	//Route::add( 'POST', '/search/csv', function(){
	Route::add( 'POST', '/search/csv', function(){
		$token = JWT::decode(JWT::getBearerToken(), Config::JWT_PASSWORD);
		if(array_key_exists('error', $token)) {
			Rest::sendResponse(400, $token);
		} else if(array_key_exists('fct', $token)){
			if($token['fct'] == 'csvGenerate'){
				$db = new mysqli( Config::DB_HOST, Config::DB_USERNAME, Config::DB_PASSWORD, Config::DB_NAME, Config::DB_PORT );
				$db->set_charset('utf8');
				$titulos = array('Fecha de captura', 'Id', 'Estado', 'Ciudad', 'Id Tienda', 'Tienda', 'Nombre', 'Segundo Nombre', 'Apellido Paterno', 'Apellido Materno', 'Teléfono', 'Celular', 'Producto', 'Email', 'Fecha de modificación', 'Status', 'horario_de_contacto_preferente');

				$query = $db->query("SELECT DATE_FORMAT(DATE(DATE_ADD(i.created_at, INTERVAL - 6 HOUR)), '%d/%m/%Y') AS created, i.id, s.estado, s.ciudad, CASE WHEN i.proceso = 0 THEN FORMAT(9999, 0) ELSE FORMAT(i.tienda_id, 0) END AS id_tienda, s.tienda, TRIM(i.nombre) AS nombre, TRIM(i.segundo_nombre) AS segundo_nombre, TRIM(i.apellido_paterno) AS apellido_paterno, TRIM(i.apellido_materno) AS apellido_materno, '5555555555' AS telefono, i.telefono AS celular, IFNULL(NULLIF(i.producto, ''), IFNULL(i.product_name, 'NA')) AS producto, CASE WHEN i.proceso = 0 THEN 'Información' ELSE 'NULL' END AS email, DATE_FORMAT(DATE(DATE_ADD(i.updated_at, INTERVAL - 6 HOUR)), '%d/%m/%Y') AS updated, 'Nuevo' AS status, '' AS horario_preferente FROM informes AS i LEFT JOIN sucursales AS s ON s.tienda_id = i.tienda_id WHERE i.created_at BETWEEN '".date('Y/m/d H:i:s.000',strtotime('-2 days 18 hours'))."' AND '".date('Y/m/d H:i:s.999',strtotime('+6 hours'))."';");

				$files = glob('../csv/*');
				foreach($files as $file){
					if(is_file($file))
						unlink($file);
				}

				$publicURL = str_replace( API_VERSION . '/search/csv', '', CURRENT_URI );
				$fileName = 'data-' . date('d.m.y-His') . '.csv';
				
				$fp = fopen( '../csv/' . $fileName, 'w' );
				fputs($fp, "\xEF\xBB\xBF"); fputcsv($fp, $titulos);
				foreach($query as $campos){ fputcsv($fp, $campos); }
				fclose($fp);

				Rest::sendResponse(200, ['description' => 'OK', 'url' => $publicURL . 'csv/' . $fileName]);
			}
		} else {
			Rest::sendResponse(401, ['description' => 'No tienes los permisos necesarios']);
		}
	});

	// Establecemos los valores de error por default e iniciamos la app con el directorio actual del API
	Route::pathNotFound( function(){ Rest::sendResponse(404, [ 'description' => 'Not Found' ]); } );
	Route::methodNotAllowed( function($path, $method) { Rest::sendResponse(400, [ 'description' => 'Method Not Allowed' ]); } );
	Route::run( API_DIR );