<?php 
session_start();
require_once('./include/connect.php');

$BookDeleteID = $_REQUEST['id'];
var_dump($BookDeleteID);
// ELIMINAR IMAGEN DEL SERVIDOR
$sql = mysqli_query($link," SELECT imagen_libro FROM libros WHERE id_libro = $BookDeleteID ");
while($img = mysqli_fetch_array($sql)) {
	unlink($img['imagen_libro']);
}
mysqli_query($link," DELETE FROM libros WHERE id_libro = $BookDeleteID ") or die ('No se ha podido eliminar');
mysqli_close($link);
$message_action = "<p class='text-primary'>El libro ha sido eliminado de la base de datos exitosamente.</p>";
$_SESSION['message_action'] = $message_action;
mysqli_close($link);
header("location: ./admintable.php");
?>
</main>
</body>
</html>