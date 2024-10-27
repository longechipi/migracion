<?php 
require('../../conf/conex.php');
require('../../controller/log.php');

$id_user = $_POST['id_user'];
$correo = $_POST['usuario'];

$clave_tmp = mt_rand(10000000, 99999999);
$hash = password_hash($clave_tmp, PASSWORD_DEFAULT);

$b="UPDATE users SET clave = '$hash' WHERE id_user=$id_user AND usuario = '$correo'";
$bres = $mysqli->query($b);
if ($bres) {
    //-------- Si funciona envia Correo -------//
    include('../../mail/reset_pass.php');
    register_log($mysqli, $id_user,'REINICIO CONTRASEÑA', 'USUARIOS', 'USUARIO ADMINISTRADOR REINICIO LA CONTRASEÑA DEL USUARIO CON ID: '.$id_user.'');
    echo 1;
}else{
    echo 0;
}
?>