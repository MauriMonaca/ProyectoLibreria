<?php
session_start();
require_once('./include/connect.php');
$message_book = '';
if ( isset($_POST['sendbook']) && ($_POST['sendbook'] == "Dar de Alta") ){

	if ( isset($_FILES['imgbook']) && ($_FILES['imgbook']['error'] === UPLOAD_ERR_OK) ) {
		//DETALLES DE LA IMAGEN
		$imgTempPath = $_FILES['imgbook']['tmp_name'];
		$imgName = $_FILES['imgbook']['name'];
		$imgSize = $_FILES['imgbook']['size'];
		$imgType = $_FILES['imgbook']['type'];
		$imgNameParts = explode(".",$imgName);
		$imgExtension = strtolower(end($imgNameParts));
		//LIMPIAR NOMBRE DE IMG
		$newImgName = md5(time() . $imgName) . '.' . $imgExtension;
		// CHECKEAR SI TIENE UNA DE LAS SIGUIENTES EXTENSIONES
		$extensionsAllowed = array('jpg','jpeg','png','gif');

		if (in_array($imgExtension, $extensionsAllowed)) {
				$kb_limit = 400;
			if ($imgSize <= $kb_limit*1024) {
				// CARPETA DE LA IMG
				$uploadFolder = './book-img/';
				$imgPath = $uploadFolder . $newImgName;

				if(move_uploaded_file($imgTempPath, $imgPath)) {
					$message_book = '<p class="text-success">Alta de libro satisfactoria.</p>';
				}
				else { $message_book = '<p class="text-danger">Error en la subida de imagen a la carpeta destino. Asegúrese de 	que el servidor pueda escribir en esa carpeta.</p>';
				}	
			}
			else {
				$message_book = '<p class="text-danger">Error. Asegúrese de que la imagen pese menos de 400kb.</p>';
			}
		}
		else {
			$message_book = '<p class="text-danger">Error. Solo se permiten los siguientes formatos de imagen: ' . implode(',',$extensionsAllowed) . '.</p>';
		}
	}
	else {
		$message_book = '<p class="text-danger">Error en la subida de imagen: ' . $_FILES['imgbook']['error'] . '.</p>';
	}

$title = utf8_encode($_POST['title']);
$isbn = utf8_encode($_POST['isbn']);
$author = utf8_encode($_POST['author']);
$editorial = utf8_encode($_POST['editorial']);
if ($editorial == "") {
	$message_book = "<p class='text-danger'>Por favor, elija una editorial de la lista.</p>";
	header("location: ./uploadbook.php");
	die;
}
$price = utf8_encode($_POST['price']);
$stock = utf8_encode($_POST['stock']);
$description = htmlspecialchars($_POST['description']);
$anio = utf8_encode($_POST['anio']);
$subject = $_POST["subject"];
$subject = implode(" ", $subject);
if (empty($subject)){
	$message_book = '<p class="text-danger">Por favor elija una temática para el libro.</p>';
	header("location: ./uploadbook.php");
	die;
}
$sql = "INSERT INTO libros VALUES 
	(null,'$isbn','$title','$author','$imgPath','$description','$price','$stock','$editorial','$anio','$subject')";

mysqli_query($link,$sql) or die ('No se insertó el registro');
mysqli_close($link);

$_SESSION['message_book'] = $message_book;
header("location: ./uploadbook.php");
}
?>