<?php
session_start();
require_once('./include/connect.php');
if ( (isset($_SESSION['user'])) || (isset($_SESSION['admin'])) ) {
 header("location: ./index.php");
} 
$message_account = '';
if ( isset($_POST['account']) && ($_POST['account'] == "Crear Cuenta") ) {

	if (isset($_POST['username'])) {
		$nameAcc = $_POST['username'];
		// VALIDAR USUARIO
		if ($nameAcc == "") {
			$message_register = "Debe ingresar un nombre de usuario.";
			$_SESSION['message_register'] = $message_register;		
			header("location: ./register.php");
			exit();
		}
		// VALIDAR EMAIL
		$email = $_POST['email'];
		if ($email == "" || strpos($email,"@") === false) {
			$message_register = "Ingrese un correo electrónico válido";
			$_SESSION['message_register'] = $message_register;
			header("location: ./register.php");
			exit();
		}
		// VALIDAR CONTRASEÑA
		$pass1 = $_POST['pass1'];
		if ($pass1 == "" || strlen($pass1) < 6) {
			$message_register = "El campo contraseña no puede estar vacío, y debe tener un mínimo de 6 caractéres.";
			$_SESSION['message_register'] = $message_register;
			header("location: ./register.php");
			exit();
		}
		$pass2 = $_POST['pass2'];
		if ($pass2 == "" || strlen($pass2) < 6) {
			$message_register = "El campo contraseña no puede estar vacío, y debe tener un mínimo de 6 caractéres.";
			$_SESSION['message_register'] = $message_register;
			header("location: ./register.php");
			exit();
		}
		if ($pass1 !== $pass2) {
			$message_register = "Su Contraseña no es la misma. Asegúrese de confirmar bien su contraseña de la cuenta.";
			$_SESSION['message_register'] = $message_register;
			header("location: ./register.php");
			exit();
		}
		// VALIDAR INPUT RADIO
		$gender = $_POST['gender'];
		if (!isset($gender)) {
			$gender = "";
			$message_register = "Seleccione su género.";
			$_SESSION['message_register'] = $message_register;
			header("location: ./register.php");
			exit();
		}
		// VALIDAR POLITICAS DE PRIVACIDAD
        if (!isset($_POST['priv'])) {
        	$message_register = "Por favor acepte las políticas de privacidad.";
        	$_SESSION['message_register'] = $message_register;
        	header("location: ./register.php");
			exit();
		}
		$nameAcc = strip_tags(mysqli_real_escape_string($link,trim($nameAcc)));
		$email = strip_tags(mysqli_real_escape_string($link,trim($email)));
		// ENCRIPTANDO CONTRASEÑA
		$hash = password_hash($pass1, PASSWORD_DEFAULT);

 		// VERIFICAR SI ESE USUARIO YA EXISTE EN LA BD
		$users = "SELECT * FROM usuarios WHERE nombre = '$nameAcc' ";
		$query_users = mysqli_query($link,$users);
		if (mysqli_num_rows($query_users) > 0) {
			$message_register = "Ese nombre de usuario ya existe";	
			$_SESSION['message_register'] = $message_register;
			header("location: ./register.php");
			exit();		
		}

 		// VERIFICAR SI ESE EMAIL YA EXISTE EN LA BD
		$userEmail = "SELECT * FROM usuarios WHERE email = '$email' ";
		$query_userEmail = mysqli_query($link,$userEmail);
		if (mysqli_num_rows($query_userEmail) > 0) {
			$message_register = "Ese e-mail ya está registrado";	
			$_SESSION['message_register'] = $message_register;
			header("location: ./register.php");
			exit();		
		}

		// EN CASO DE QUE ESTE BIEN INSERTAR USUARIO
		$sql = "INSERT INTO usuarios VALUES 
			(null,'$nameAcc','$email','$gender','$hash','usuario')";
		mysqli_query($link,$sql) or die ('No se ha podido crear la cuenta.<br>');
		mysqli_close($link);

		// TXT CON NOMBRES DE USUARIO
		$filemsg = "Nombre de Usuario: $nameAcc" . PHP_EOL .
				   "Email: $email" . PHP_EOL .
				   "Sexo: $gender" . PHP_EOL .
				    PHP_EOL . PHP_EOL;
		$filetxt = fopen("usuarios.txt","a");
		fwrite($filetxt,$filemsg);
		fclose($filetxt);

		$message_register = "Su cuenta ha sido creada, ya puede iniciar sesión.";
		$_SESSION['message_register'] = $message_register;
		header("location: ./login.php");
	}
}