<?php 
require_once('../conf/conex.php');
require_once('../controller/');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user = trim($_POST['usuario']);
    $pass = trim($_POST['clave']);

$a = "SELECT U.id_user, U.nombre, U.apellido, U.usuario, U.clave, US.id_sta, UP.id_pri FROM users U 
INNER JOIN users_status US ON U.id_user = US.id_user
INNER JOIN users_privilegios UP ON U.id_user = UP.id_user
WHERE US.id_sta = 1
AND U.usuario = '$user'";
$ares= $mysqli->query($a);
    if ($ares->num_rows > 0){
        //------- EXISTE USUARIO -------//
        $row = $ares->fetch_assoc();
        $pass_hash = $row['clave'];
        if (password_verify($pass, $pass_hash)) {
            if ($row['id_sta'] == 1){
                session_start();
                $_SESSION['loggedin'] = true; // Usuario autenticado
                $_SESSION['id_user'] = $row['id_user']; // ID del usuario
                $_SESSION['id_pri'] = $row['id_pri']; // Privilegios del usuario
                header('location: ../html/inicio');
            }elseif($row['id_sta'] == 3){
                echo "Usuario bloqueado";
            }else{
                echo "Usuario inactivo";
            }
        }else{
            echo "Contraseña incorrecta";
        }
    }else{
        echo "Usuario no existe";
    }
}else{
    echo "NO FUE POR ACA";
}
?>