<?php
session_start();
require_once('./include/connect.php');
$contact = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ( isset($_POST['username'])) {
		$name = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	}
    if (isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    if (isset($_POST['subject'])) {
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
    }

	$mymail = "mauri.m73@hotmail.com";

    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";

	if(mail($mymail, $subject, $message, $headers)) {
	    $contact = "Gracias por contactarnos, $name. Pronto recibirá una respuesta.";
	} 
	else {
	    $contact = 'Ha ocurrido un problema, el email no pudo ser enviado.';
	}
}
else {
	$contact = 'Ocurrió un error';
}
$_SESSION['contact'] = $contact;
header("location: ./contactform.php");
