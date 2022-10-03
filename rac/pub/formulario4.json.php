<?php
//Desactivar toda notificación de error
//error_reporting(0);

include('PHPMailer/PHPMailer.php');
include('PHPMailer/Exception.php');
include('PHPMailer/SMTP.php');
	
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function enviarMail($correo){
	

$mail = new PHPMailer(true);

// Send mail using Gmail

$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
$mail->Port = 465; // set the SMTP port for the GMAIL server
$mail->Username = "info@raclatino.com"; // GMAIL username
$mail->Password = "qaz589!@"; // GMAIL password



/*
// Typical mail data
$mail->AddAddress($correo);
$mail->SetFrom($mail->Username);
*/

//$mail = new PHPMailer(true);

//$mail->IsSMTP();
//$mail->SMTPAuth = true;
//$mail->SMTPSecure = 'tls';
    //$mail->Username = "info@raclatino.com";
    //$mail->Password = "qaz589!@";
    //$mail->Host = "smtp.gmail.com";
    //$mail->Port = 587;
    
     
    $mail->From = "info@raclatino.com";
    $mail->FromName = "info";
$mail->AddAddress($correo);


$mail->Subject = "Gracias por registrarte";
$mail->Body = "Gracias por registrarte en nuestra pagina de RAC. En breve, un representante de RAC se pondra en contacto contigo para brindarte mas informacion acerca de nuestros productos y promociones.";	



try{
    $mail->Send();
} catch(Exception $e){
    error_log("Fallo envio de correo! $correo " . $e, 0);
}

/*
try{
    $mail->Send();
    echo "Success!";
} catch(Exception $e){
    // Something went bad
    echo "Fail :(";
}
*/

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
    $a[] = array();//array("value" => "" , "estado" => "");
    while($r = mysqli_fetch_assoc($result)) {
        $a[] = array("value" => utf8_encode( $r['id'] ) , "estado" => utf8_encode( $r['nombre'] ) ) ;
    }
    $myJSON = json_encode( $a );
}elseif ( isset( $_GET['festados'] ) ){
    $query = "SELECT id,nombre FROM estados";
    $result = $conn->query($query);
    $a[] = array();//array("value" => "" , "estado" => "");
    while($r = mysqli_fetch_assoc($result)) {
        $a[] = array("value" => utf8_encode( $r['id'] ) , "estado" => utf8_encode( $r['nombre'] ) ) ;
    }
    $myJSON = json_encode( $a );
}elseif ( isset( $_GET['festadomunicipio'] ) ){
    $query = "SELECT id,nombre FROM municipios WHERE estado_id = " . $_GET['festadomunicipio'];
    $result = $conn->query($query);
    $a[] = array();//array("value" => "" , "estado" => "");
    while($r = mysqli_fetch_assoc($result)) {
        $a[] = array("value" => utf8_encode( $r['id'] ) , "estado" => utf8_encode( $r['nombre'] ) ) ;
    }
    $myJSON = json_encode( $a );
}elseif( isset( $_GET['ftienda'] ) ){
    $query = "SELECT id,nombre FROM tiendas WHERE idestado = " . $_GET['festado'] . " AND idmunicipio = " . $_GET['fmunicipio'] ;
    $result = $conn->query($query);
    $a[] = array();//array("value" => "" , "estado" => "");
    while($r = mysqli_fetch_assoc($result)) {
        $a[] = array("value" => utf8_encode( $r['id'] ) , "estado" => utf8_encode( $r['nombre'] ) ) ;
    }
    $myJSON = json_encode( $a );
}elseif( isset( $_GET['submit'] ) ){
    if ($_GET['submit'] == 'order66'){
        //aqui llenamos todo el codigo
        
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
