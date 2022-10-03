<?php

//if ($_POST) {
//    //print_r($_POST);
//    /* Variables */
//    $nombre = $_POST["nombre"];
//    $empresa = $_POST["empresa"];
//    $correo = $_POST["correo"];
//    $cantidad = $_POST["cantidad"];
//    $sector = $_POST["sector"];
//    $especificaciones = $_POST["especificaciones"];
//
//    $multiple_recipients = 'roberto.guzman@leancommerce.mx,eloisa.c@remedia.com.mx';
//
//    $to = $multiple_recipients;
//    $subject = 'Solicitud de cotización - Unifform';
//    $body = '<h1><strong>Solicitud de cotización</strong></h1><br />'
//            . '<h2><strong>Datos del solicitante</strong></h2>'
//            . '<table>'
//            . '<tr><td>Nombre:</td><td>' . $nombre . '</td></tr>'
//            . '<tr><td>Empresa:</td><td>' . $empresa . '</td></tr>'
//            . '<tr><td>Correo:</td><td>' . $correo . '</td></tr>'
//            . '<tr><td>Cantidad:</td><td>' . $cantidad . '</td></tr>'
//            . '<tr><td>Sector:</td><td>' . $sector . '</td></tr>'
//            . '<tr><td>Especificaciones:</td><td>' . $especificaciones . '</td></tr>';
//    $body .= '</table>';
//    $body .= "<br />Este formulario fue enviado desde la página web www.unifform.mx";
//    $headers = "From: Cotizaciones Unifform <contacto@unifform.mx>\r\n". 
//                   "MIME-Version: 1.0" . "\r\n" . 
//                   "Content-type: text/html; charset=UTF-8" . "\r\n"; 
//
//    if ($nombre != "" && $empresa != "" && $correo != "" && $cantidad != "" && $sector != "" && $especificaciones != "") {
//        if(mail($to, $subject, $body, $headers)) {
//            echo 'ok';
//            exit();
//        } else {
//            echo 'error';
//        }
//    }
//    echo 'error';
//    exit();
//}