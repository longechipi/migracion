<?php 
require('../../../conf/conex.php');
require('../../../controller/log.php');

//---------- Datos del formulario ------------//
$id = $_POST['id'];
$id_user = $_POST['id_user_ban'];
$id_ban = $_POST['id_ban'];
$id_tip_cuenta = $_POST['id_tip_cuenta'];
$nro_cuenta = trim($_POST['nro_cuenta']);
$ach = empty($_POST['ach']) ? '0' : $_POST['ach'];
$swit = empty($_POST['swit']) ? '0' : $_POST['swit'];
$aba = empty($_POST['aba']) ? '0' : $_POST['aba'];
$id_sta = $_POST['id_sta'];
$tipo_estatus = ($id_sta == 1) ? 'CUENTA ACTIVADA' : 'CUENTA DESACTIVADA';

//----- Actualiza Primero el Estatus de la Cuenta ------//
$a="UPDATE datos_bancarios_med SET id_sta = $id_sta WHERE id = $id AND id_user = $id_user AND id_ban = $id_ban";
$ares = $mysqli->query($a);

//----- Valido Cambio y si Desactiva todo Reverso -----//
$b = "SELECT id_sta FROM datos_bancarios_med WHERE id_user = $id_user";
$bres = $mysqli->query($b);
$cuentas_activas = 0;
$cuentas_desactivadas = 0;
while ($row = $bres->fetch_assoc()) {
    if ($row['id_sta'] == 1) {
        $cuentas_activas++;
    } else if ($row['id_sta'] == 2) {
        $cuentas_desactivadas++;
    }
}
if ($cuentas_activas == 0) {
    $c="UPDATE datos_bancarios_med SET id_sta = 1 WHERE id = $id AND id_user = $id_user AND id_ban = $id_ban";
    $cres = $mysqli->query($c);
    echo 2;
    //------ REGISTRO DE LOG -------//
    register_log($mysqli, $id_user,'CAMBIO STATUS', 'PERFIL', 'USUARIO INTENTO CAMBIAR ESTATUS DE CUENTA, SE REVERSA POR CUENTAS INACTIVAS'); 

} else if ($cuentas_activas == 1 && $cuentas_desactivadas > 0) {
    $d="UPDATE datos_bancarios_med SET id_ban = '$id_ban', id_tip = '$id_tip_cuenta', 
    nro_cuenta = '$nro_cuenta', ach = '$ach', swit = '$swit', aba = '$aba', id_sta = $id_sta
    WHERE id = $id AND id_user = $id_user";
    $bres = $mysqli->query($b);
    if ($bres) {
        //------ REGISTRO DE LOG -------//
        register_log($mysqli, $id_user,'CAMBIO STATUS', 'PERFIL', 'USUARIO CAMBIO ESTATUS DE A: '.$tipo_estatus.'');
        echo 1;
    } else {
        echo 3;
    }
} else {
    $d="UPDATE datos_bancarios_med SET id_ban = '$id_ban', id_tip = '$id_tip_cuenta', 
    nro_cuenta = '$nro_cuenta', ach = '$ach', swit = '$swit', aba = '$aba', id_sta = $id_sta
    WHERE id = $id AND id_user = $id_user";
    $bres = $mysqli->query($b);
    if ($bres) {
        //------ REGISTRO DE LOG -------//
        echo 1;
        register_log($mysqli, $id_user,'CAMBIO STATUS', 'PERFIL', 'USUARIO CAMBIO ESTATUS DE A: '.$tipo_estatus.'');
    } else {
        echo 3;
    }
}
?>