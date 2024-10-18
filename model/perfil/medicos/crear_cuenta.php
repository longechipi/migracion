<?php
require('../../../conf/conex.php');
require('../../../controller/log.php');

$id_user = trim($_POST['id_user']);
$naci = trim($_POST['naci']);
$id_ban = trim($_POST['id_ban']);
$id_tip_cuenta = trim($_POST['id_tip_cuenta']);
$nro_cuenta = trim($_POST['nro_cuenta']);
$ach = empty($_POST['ach']) ? '0' : $_POST['ach'];
$swit = empty($_POST['swit']) ? '0' : $_POST['swit'];
$aba = empty($_POST['aba']) ? '0' : $_POST['aba'];

$a="INSERT INTO datos_bancarios_med(id_user, id_ban, id_tip, nro_cuenta, ach, swit, aba, id_sta)
VALUES($id_user, $id_ban, $id_tip_cuenta, '$nro_cuenta', '$ach', '$swit', '$aba', 1)";
$ares=$mysqli->query($a);
if($ares){
    //----- Registro de Log -----//
    echo 1;
    register_log($mysqli, $id_user,'CREACION CUENTA', 'PERFIL', 'USUARIO CREO UNA NUEVA CUENTA BANCARIA');
}else{
    echo 0;
}
?>
