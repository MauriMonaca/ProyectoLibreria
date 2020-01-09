<?php
session_start();
require_once('./include/connect.php');
if(isset ($_SESSION['cart']) && isset ($_SESSION['user']) ){
	$array = $_SESSION['cart'];
	foreach ($array as $row) {
	$id = $row['id'];
	$lessStock = $row['quantity']; 
	$sql_update = "UPDATE libros SET 
		stock_libro = stock_libro - '$lessStock'
		WHERE id_libro = '$id'";
		mysqli_query($link,$sql_update) or die ('No se modificó el registro');
	}
	unset($_SESSION['cart']);
	unset($_SESSION['total']);
	echo "<script type='text/javascript'>
    alert('Compra exitosa..! Muchas gracias');
    window.location.href='index.php';</script>";
	mysqli_close($link);
}
else {
	echo "<script type='text/javascript'>
	if (window.location == 'http://localhost/cursos/callejon/buybook.php'){
		if (localStorage.getItem('quantities')) {
			console.log('hola');
			localStorage.removeItem('quantities');
		}
	}
    alert('Compra no realizada, su carrito esta vacío');
    window.location.href='index.php';</script>";
	mysqli_close($link);
	header('location: ./index.php');
}
