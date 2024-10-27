<?php 
require('../../conf/conex.php');
require('../../controller/log.php');

$usuario = trim($_POST['usuario']);
$nom_user = strtoupper($_POST['nom_user']);
$apel_user = strtoupper($_POST['apel_user']);
$privi = $_POST['privi'];
$sta_user = $_POST['sta_user'];

function limpiarCorreo($usuario) {
    $usuario = trim($usuario);
    $usuario = filter_var($usuario, FILTER_SANITIZE_EMAIL);
    return $usuario;
}
$correoLimpio = limpiarCorreo($usuario);

$pass = $_POST['pass'];
$hash = password_hash($pass, PASSWORD_DEFAULT);

$a = "INSERT INTO users(nombre, apellido, usuario, clave)VALUES('$nom_user', '$apel_user', '$correoLimpio', '$hash')";
$ares = $mysqli->query($a);
$last_id = $mysqli->insert_id;
if($ares){
    $b = "INSERT INTO users_privilegios(id_user, id_pri)VALUES($last_id, $privi)";
    $bres = $mysqli->query($b);
    if($bres){
        $c = "INSERT INTO users_status(id_user, id_sta)VALUES($last_id, $sta_user)";
        $cres = $mysqli->query($c);
        if($cres){
            register_log($mysqli, $id_user, 'CREO USUARIO', 'USUARIOS', 'ADMINISTRADOR CREO UN USUARIO CON EL ID: '.$last_id.', PRIVILEGIOS DE NIVEL: '.$privi.' Y CON STATUS: '.$sta_user.'');
            echo 1;
        }else{
            echo "FALLO EN EL TERCERO";
        }
    }else{
        echo "FALLO EN EL SEGUNDO";
    }
    
}else{
    echo "FALLO EN EL PRIMERO";
}