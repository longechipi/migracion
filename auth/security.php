<?php 
require_once('../conf/conex.php');
require_once('../controller/log.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user = trim($_POST['usuario']);
    $pass = trim($_POST['clave']);

$a = "SELECT U.id_user, U.nombre, U.apellido, U.usuario, U.clave, US.id_sta, UP.id_pri FROM users U 
INNER JOIN users_status US ON U.id_user = US.id_user
INNER JOIN users_privilegios UP ON U.id_user = UP.id_user
WHERE U.usuario = '$user'
AND US.id_sta IN (1,4)";
$ares= $mysqli->query($a);

    if ($ares->num_rows > 0){
        //------- EXISTE USUARIO -------//
        $row = $ares->fetch_assoc();
        $pass_hash = $row['clave'];
        if (password_verify($pass, $pass_hash)) {
            if (($row['id_sta'] == 1) || ($row['id_sta'] == 4)){
                session_start();
                $_SESSION['loggedin'] = true; // Usuario autenticado
                $_SESSION['id_user'] = $row['id_user']; // ID del usuario
                $_SESSION['id_pri'] = $row['id_pri']; // Privilegios del usuario
                $_SESSION['id_sta'] = $row['id_sta']; // Estado del Pago del usuario
                $_SESSION['usuario'] = $row['usuario']; // Usuario del Sistema
                $_SESSION['nombre'] = $row['nombre'] .' '. $row['apellido']; // Nombre del Usuario
                register_log($mysqli, $row['id_user'],'LOGIN', 'AUTH', 'USUARIO ENTRO AL SISTEMA'); //Funcion para Registrar Logs
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