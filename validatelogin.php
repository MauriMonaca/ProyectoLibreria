 <?php 
session_start();
require_once('include/connect.php');
if ( (isset($_SESSION['user'])) || (isset($_SESSION['admin'])) ) {
 header("location: ./index.php");
} 
if (isset($_POST['user']) && isset($_POST['password'])) {
    $name = $_POST['user'];
    $pass = $_POST['password'];
    
    $name = strip_tags(mysqli_real_escape_string($link,trim($name)));
    $pass = strip_tags(mysqli_real_escape_string($link,trim($pass)));
    $sql =  " SELECT * FROM usuarios WHERE nombre = '" . $name . "' ";
    $query = mysqli_query($link,$sql);  
    if (mysqli_num_rows($query) > 0 ) {
        $row = mysqli_fetch_array($query);
        $password_hash = $row['password'];
        if (password_verify($pass,$password_hash)) {
                if ($row['rol'] == "administrador") {
                    $_SESSION['admin'] = '--Administrador--';
                    // SETEAMOS COOKIE PARA RECORDAR USUARIO
                    if (isset($_POST['remember'])) {
                        if ($_POST['remember'] == true) {
                            setcookie("username",$name,time()+(60*60*24*30));
                            setcookie("clave",$pass,time()+(60*60*24*30));
                        }
                    }
                    header("location: ./index.php");
                }
                else {
                     $_SESSION['user'] = $name;
                        if (isset($_POST['remember'])) {
                            if ($_POST['remember'] == true) {
                                setcookie("username",$name,time()+(60*60*24*30));
                                setcookie("clave",$pass,time()+(60*60*24*30));
                            }
                        }
                    header("location: ./index.php");
                }
            }
        else {
                $message_login = "Contraseña incorrecta. Ingrese los datos nuevamente.";
                $_SESSION['message_login'] = $message_login;
                header("location: ./login.php");
            }
        }
    else {
            $message_login = "No existe ese nombre de Usuario. Ingrese los datos correctamente.";
            $_SESSION['message_login'] = $message_login;
            header("location: ./login.php");
    }
}
// SETEAMOS COOKIE PARA RECORDAR USUARIO
if (isset($_POST['remember'])) {
    if ($_POST['remember'] == true) {
        setcookie("username",$name,time()+(60*60*24*30));
        setcookie("clave",$pass,time()+(60*60*24*30));
    }
}

 mysqli_close($link);



