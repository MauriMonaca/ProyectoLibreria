<?php
session_start();
require_once('./include/connect.php');
if ( (isset($_SESSION['user'])) || (isset($_SESSION['admin'])) ) {
 header("location: ./index.php");
} 
if(!empty($_POST))
{
	$email = $_POST['email'];
	if ($email == "" || strpos($email,"@") === false) {
	$message_forget = "Ingrese un correo electrónico válido";
	$_SESSION['message_forget'] = $message_forget;
	header("location: ./forgetpassword.php");
	exit();
	}
	$email = strip_tags(mysqli_real_escape_string($link,trim($email)));
	// VER SI ESE EMAIL ESTA REGISTRADO EN BASE DE DATOS
	$email_search = "SELECT * FROM usuarios WHERE email = '$email' ";
	$query_users = mysqli_query($link,$email_search) or die ('El e-mail que usted introdujo no está registrado como una cuenta válida.');
	if (mysqli_num_rows($query_users) < 1) {
		$message_forget = "El e-mail que usted introdujo no está registrado como una cuenta válida.";
		$_SESSION['message_forget'] = $message_forget;
		header("location: ./forgetpassword.php");
		exit();		
	}
	// TOKEN PARA NUEVA CONTRASEÑA
	$newPass = bin2hex(random_bytes(5));
	// CAMBIO DE CONTRASEÑA
	$update = " UPDATE usuarios SET password = '$newPass' WHERE email = '$email' ";
	mysqli_query($link,$update) or die ('No se pudo modificar la contraseña');
    // BUSCAMOS EL  NOMBRE DEL USUARIO
    $name_user =  "SELECT nombre FROM usuarios WHERE email = '$email' ";
    $query_name = mysqli_query($link,$name_user);
    while ($single = mysqli_fetch_array($query_name)){
    	$singleUser = $single['nombre'];
    }
    // PARAMETROS DEL EMAIL
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . "mauri.m73@hotmail.com" . "\r\n";
    $subject = "Cambio de Contraseña - Libreria Gran Callejón".
    $message = "Hola $singleUser, Usted a Solicitado un cambio de contraseña." . "\n" .
    		   "Su nueva clave es $newPass". "\n" . "Saludos, Librería Gran Callejón";
    // ENVIO DE EMAIL
	if (mail($mymail, $subject, $message, $headers)) {
	    $message_forget = "Se le ha enviado un e-mail con su nueva contrasenia $singleUser.";
	    header("location: ./login.php");
	} 
	else {
	    $message_forget = "Ha ocurrido un problema, el email no pudo ser enviado .";
	    header("location: ./forgetpassword.php");
	}
	$_SESSION['message_forget'] = $message_forget;
	mysqli_close($link);
}
