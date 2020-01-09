<?php
	$Server = "127.0.0.1";
	$User_db = "root";
	$Password_db = "";
	$DataBase = "grancallejon";


	$link = mysqli_connect($Server,$User_db,$Password_db) or die ("Error en la conexion");
	$link->set_charset('utf8');
	$db = mysqli_select_db($link,$DataBase) or die ("Error de acceso a la base de datos");
?>