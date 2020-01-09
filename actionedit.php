<?php
session_start();
require('./include/connect.php');

$message_action = '';

if ( isset($_POST['editbook']) && ($_POST['editbook'] == "Aceptar") ){

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
					$message_action = '<p class="text-success">Modificación de libro satisfactoria.</p>';
				}
				else { $message_action = '<p class="text-danger">Error en la subida de imagen a la carpeta destino. Asegúrese de 	que el servidor pueda escribir en esa carpeta.';
				}	
			}
			else {
				$message_action = '<p class="text-danger">Error. Asegúrese de que la imagen pese menos de 400kb.';
			}
		}
		else {
			$message_action = '<p class="text-danger">Error. Solo se permiten los siguientes formatos de imagen: ' . implode(',',$extensionsAllowed) . '.';
		}
	}
	else {
		$message_action = '<p class="text-danger">Error en la subida de imagen: ' . $_FILES['imgbook']['error'] . '.';
	}
}

if (isset($_POST['id'])) {
	$BookID = $_POST['id'];
	$isbn = $_POST['isbn'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$description = htmlspecialchars($_POST['description']);
	$price = $_POST['price'];
	$stock = $_POST['stock'];
	$editorial = $_POST['editorial'];
	$anio = $_POST['anio'];
	$subject = $_POST["subject"];
	$subject = implode(" ", $subject);
	if (empty($subject)){
	$message_action = '<p class="text-danger">Por favor elija una temática para el libro.</p>';
	}
	// ELIMINANDO IMAGEN ANTIGUA DEL SERVER
	$delete_old_image = mysqli_query($link,"SELECT imagen_libro FROM libros WHERE id_libro = $BookID");
	while($img = mysqli_fetch_array($delete_old_image)) {
		unlink($img['imagen_libro']);
	}
	// ------------------------
	$sql_update = "UPDATE libros SET 
		isbn = '$isbn', 
		nombre_libro = '$title', 
		autor_libro = '$author',
		imagen_libro = '$imgPath',
		descripcion_libro = '$description',
		precio_libro = '$price',
		stock_libro = '$stock',
		editorial = '$editorial',
		anio = '$anio',
		tematicas = '$subject'
		WHERE id_libro = '$BookID'";
	}
	mysqli_query($link,$sql_update) or die ('No se modificó el registro');
	mysqli_close($link);

$_SESSION['message_action'] = $message_action;
header("location: ./admintable.php");
