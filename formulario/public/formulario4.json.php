<?php
//Desactivar toda notificación de error
//error_reporting(0);

function enviarMail($correo){
	return true;
}


//$conn = new mysqli("localhost", "root", "", "softok2_rac");
//$conn = new mysqli("siav-db1.cwjxfmu054f4.us-east-1.rds.amazonaws.com", "RWnndJ8h", '2ruTrejU$PaS', "softok2_rac");
$conn = new mysqli("webdb.cldrbgewa4bb.us-east-1.rds.amazonaws.com", "RWnndJ8h", '2ruTrejU$PaS', "softok2_rac");

class MyO {
    public $name = "";
    public $age = 0;
    public $city = "";
}
$myObj = new MyO();

$myObj->name = "John";
$myObj->age = 30;
$myObj->city = "New York";

$myJSON = json_encode(array());

//{"name":"John","age":30,"city":"New York"}

if ( isset( $_GET['fproductos'] ) ){
    $query = "SELECT id,nombre FROM contactos_producto";
    $result = $conn->query($query);
    $a[] = array();
    while($r = mysqli_fetch_assoc($result)) {
        $a[] = array("value" => utf8_encode( $r['id'] ) , "estado" => utf8_encode( $r['nombre'] ) ) ;
    }
    $myJSON = json_encode( $a );
}elseif ( isset( $_GET['festados'] ) ){
	//SELECT * FROM `estados` 
    $query = "SELECT id,nombre FROM estados";
    $result = $conn->query($query);
    $a[] = array();
    while($r = mysqli_fetch_assoc($result)) {
        $a[] = array("value" => utf8_encode( $r['id'] ) , "estado" => utf8_encode( $r['nombre'] ) ) ;
    }
    $myJSON = json_encode( $a );
}elseif ( isset( $_GET['festadomunicipio'] ) ){
	//SELECT * FROM `ciudads` 
    $query = "SELECT id,nombre FROM municipios WHERE estado_id = " . $_GET['festadomunicipio'];
    $result = $conn->query($query);
    $a[] = array();
    while($r = mysqli_fetch_assoc($result)) {
        $a[] = array("value" => utf8_encode( $r['id'] ) , "estado" => utf8_encode( $r['nombre'] ) ) ;
    }
    $myJSON = json_encode( $a );
}elseif( isset( $_GET['ftienda'] ) ){
	//SELECT * FROM `tiendas` WHERE `estado_id` = and `ciudad_id` = 
    $query = "SELECT id,nombre FROM tiendas WHERE idestado = " . $_GET['festado'] . " AND idmunicipio = " . $_GET['fmunicipio'] ;
    $result = $conn->query($query);
    $a[] = array();
    while($r = mysqli_fetch_assoc($result)) {
        $a[] = array("value" => utf8_encode( $r['id'] ) , "estado" => utf8_encode( $r['nombre'] ) ) ;
    }
    $myJSON = json_encode( $a );
}elseif( isset( $_GET['submit'] ) ){
    if ($_GET['submit'] == 'order66'){
        //aqui llenamos todo el codigo

$query = "
	INSERT INTO `contactos`
		(`estado_id`, `ciudad_id`, `tienda_id`, `nombre`, `telefono`, `producto`, `email`) 
		VALUES 
		(
		".htmlentities($_GET['qestado'])." ,
		".htmlentities($_GET['qmunicipio']). ",
		".htmlentities($_GET['qtienda']).",
		'".utf8_decode($_GET['qnombre']. " ".$_GET['qpaterno']. " ".$_GET['qmaterno'])."',
		'".utf8_decode($_GET['qtelefonofij']). "',
		'".utf8_decode ($_GET['qproducto'])."',
		'". utf8_decode($_GET['qcorreo']). "');";
		/*
        $query = "INSERT INTO `softok2_rac`.`contactos`
(
`email`,`nombre`,`telefono`,`lada`,
`CP`,`idestado`,`idmunicipio`,`idtienda`,`comentario`,`producto`,`ip`,`hora`,`fecha`)
VALUES
(
'". utf8_decode($_GET['qcorreo']). "',  
'".utf8_decode($_GET['qnombre']. " ".$_GET['qpaterno']. " ".$_GET['qmaterno'])."', 
'".utf8_decode($_GET['qtelefonofij']). "', 
NULL, 
NULL,
".htmlentities($_GET['qestado']). " , 
".htmlentities($_GET['qmunicipio']). " , 
".htmlentities($_GET['qtienda']). " , 
'tel:".utf8_decode($_GET['qtelefonofij']. " cell:".$_GET['qtelefonocel']). " ',    
'".utf8_decode ($_GET['qproducto'])."', 
'".htmlentities($_SERVER['REMOTE_ADDR'])."',
'".date('H:i')."',
'".date('Y-m-d')."');";
*/
        if ($conn->query($query) === TRUE) {
			/*
			$message =  "Gracias por registrarte en nuestra página de RAC. En breve, un representante de RAC se pondrá en contacto contigo para brindarte más información acerca de nuestros productos y promociones.";	
			// use wordwrap() if lines are longer than 70 characters
			$message = wordwrap($message,70);

			// send email
			mail($almail,"Registro RAC",$message);
			*/
			enviarMail($_GET['qcorreo']);
			
            //echo "New record created successfully";
            $myJSON = json_encode( array("status" => 'ok') ); 
        } else {
            error_log("Formulario Error: " . $query . "<br>" . $conn->error,0);
            $myJSON = json_encode( array("error" =>  'Formulario incompleto.') ); 
        }
        
        
    }else{
        $myJSON = json_encode( array("error" => 'Formulario incompleto.') ); 
    }
}else{
    $myJSON = json_encode($myObj);    
}

header('Content-Type: application/json');
echo $myJSON;
?>
