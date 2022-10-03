<?php
include_once 'JWT.php';
include_once 'RestResponse.php';

$host = null;
$username = null;
$password = null;
$database = null;
$domainURL = null;

if(strpos($_SERVER['SERVER_NAME'], 'formulario') !== false) {
	$domainURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://formulario.rac.mx';
	$host = '127.0.0.1'; $username = 'root'; $password = ''; $database = 'crm_rac_02';
} elseif ( strpos($_SERVER['SERVER_NAME'], 'localhost') !== false) {
    $domainURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://localhost:8888/rac/formulario/'; 
    $host = 'localhost'; $username = 'root'; $password = 'root'; $database = 'rac';
}
$actual_link = explode('?', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")[0];

define('_DOMAIN_', $domainURL);
define('_CURRENT_LINK_', $actual_link);
define('JWT_PAS', '#qD?J!qNBX73NwJV-wUrV5nhh+FMApd!@2ud3ypx');

$rest = new RestResponse();
$rest->setAccessControlOrigin(ACCESS_CONTROL_ORIGIN);
$rest->setAccessControlMethods('POST');
$response = array();
$tokenData = JWT::decode(JWT::getBearerToken(), JWT_PAS);

// localhost:8888/rac/formulario/search/csv/

if ($_SERVER['REQUEST_METHOD'] != 'POST'){
	$response['description'] = 'Bad Allow Method';
	$rest->sendResponse(400, $response);
} else if(array_key_exists('error', $tokenData)) {
	$rest->sendResponse(400, $tokenData);
} else if(array_key_exists('fct', $tokenData)){
	if($tokenData['fct'] == 'csvGenerate'){
		$db = new mysqli($host, $username, $password, $database);
		$db->set_charset("utf8");
		$titulos = array('Fecha de captura', 'Id', 'Estado', 'Ciudad', 'Id Tienda', 'Tienda', 'Nombre', 'Segundo Nombre', 'Apellido Paterno', 'Apellido Materno', 'Teléfono', 'Celular', 'Producto', 'Email', 'Fecha de modificación', 'Status', 'horario_de_contacto_preferente');

		$query = $db->query("SELECT DATE_FORMAT(DATE(DATE_ADD(u.created_at, INTERVAL - 6 HOUR)), '%d/%m/%Y') AS created, u.id, e.nombre AS estado, c.nombre AS ciudad, FORMAT(u.tienda_id, 0) AS id_tienda, t.nombre AS tienda, u.nombre, u.segundo_nombre, u.a_paterno, u.a_materno, u.telefono, u.celular, u.producto, u.email, DATE_FORMAT(DATE(DATE_ADD(u.updated_at, INTERVAL - 6 HOUR)), '%d/%m/%Y') AS updated, s.nombre AS status, u.horario_preferente
					FROM contactos AS u
					LEFT JOIN estados AS e ON u.estado_id = e.id
					LEFT JOIN ciudads AS c ON u.ciudad_id = c.id
					LEFT JOIN tiendas AS t ON u.tienda_id = t.id
					LEFT JOIN statuses AS s ON u.status_id = s.id
					WHERE u.created_at BETWEEN '".date('Y/m/d H:i:s.000',strtotime("-2 days 18 hours"))."' AND '".date('Y/m/d H:i:s.999',strtotime("+6 hours"))."';");

		$files = glob('file/*');
		foreach($files as $file){
			if(is_file($file))
				unlink($file);
		}

		$fileName = 'data-'.date('d.m.y-His').'.csv';
		$fp = fopen('file/'.$fileName, 'w');
		fputs($fp, "\xEF\xBB\xBF"); fputcsv($fp, $titulos);
		foreach($query as $campos){ fputcsv($fp, $campos); }
		fclose($fp);
		
		$response['description'] = 'OK';
		$response['url'] = _CURRENT_LINK_.'file/'.$fileName;
		$rest->sendResponse(200, $response);
	}
} else {
	$response['description'] = 'No tienes los permisos necesarios';
	$rest->sendResponse(401, $response);
}