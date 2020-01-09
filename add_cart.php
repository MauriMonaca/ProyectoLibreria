<?php
session_start();
require_once('./include/connect.php');

if ( !isset  ($_SESSION['user']) ) {
 header("location: ./login.php");
}
else if (!isset($_REQUEST['item'])) {
	echo "<script type='text/javascript'>
    alert('Carrito vacio..');
    window.location.href='index.php';</script>";
} 
else {
$item = $_REQUEST['item']; 
$sql = "SELECT* FROM libros WHERE id_libro='$item' ";
	$query = mysqli_query($link,$sql);
	$row = mysqli_fetch_array($query);
	$stock = $row['stock_libro'];

	if ($stock < 1) {
		echo "<script type='text/javascript'>
		alert('Por el momento no hay stock de este libro! ');
		window.location.href='index.php';</script>";
	}
	else if(!isset($_SESSION['cart'])) {
		$array[0]['id'] = $row['id_libro'];
		$array[0]['name'] = $row['nombre_libro'];
		$array[0]['author'] = $row['autor_libro'];
		$array[0]['img'] = $row['imagen_libro'];
		$array[0]['price'] = $row['precio_libro'];
		$array[0]['stock'] = $row['stock_libro'];
		$array[0]['quantity'] = 1;
		$_SESSION['cart'] = $array;

		echo "<script type='text/javascript'>
		alert('Libro agregado al carrito');
		window.location.href='index.php';</script>";
		// EMPIEZA EL CONTADOR DEL CARRITO AQUI QUE LUEGO SE MUESTRA EN INDEX
		$totalBooks = 1;
		$_SESSION['total'] = $totalBooks;
	}
	else {
		$newRow['id'] = $row['id_libro'];
		$newRow['name'] = $row['nombre_libro'];
		$newRow['author'] = $row['autor_libro'];
		$newRow['img'] = $row['imagen_libro'];
		$newRow['price'] = $row['precio_libro'];
		$newRow['stock'] = $row['stock_libro'];
		$newRow['quantity'] = 1;
		// AGREGO NUEVA FILA AL CARRO
		$array = $_SESSION['cart'];
		array_push($array,$newRow);	
		// HAGO UN ARRAY CON LOS ID DE LOS PRODUCTOS	
		$col_ID = array_column($array,'id');
		$sizeCol = count($col_ID) - 1;
		// BORRO EL ULTIMO ID
		array_splice($col_ID,$sizeCol,1);
		$size = count($array) - 1;
		// Y COMPARO EL RESTO CON EL ID ACTUAL
		foreach ($col_ID as $i => $id) {
			// SI YA APARECIO ANTES, BORRO EL NUEVO ARRAY REPETIDO
			if ($id === $newRow['id']) {
				array_splice($array,$size,1);
				// $array[$i]['quantity']++;
				$totalBooks = $_SESSION['total'];
				echo "<script type='text/javascript'>
				alert('Este libro ya ha sido agregado antes!!');
				window.location.href='index.php';</script>";				
				break;
			}
			else {
				$totalBooks = $_SESSION['total'];
				$totalBooks++;
				echo "<script type='text/javascript'>
				alert('Libro agregado al carrito');
				window.location.href='index.php';</script>";
			}
		}
		unset($col_ID);
		$_SESSION['cart'] = $array;
		$_SESSION['total'] = $totalBooks;
	}
}
?>
