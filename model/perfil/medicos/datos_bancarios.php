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

//-------- Verifica que tenga al menos una cuenta Activa -------//
$a ="SELECT COUNT(*) AS cuenta FROM datos_bancarios_med WHERE id_sta = 1 AND id_user = $id_user";
$ares=$mysqli->query($a);
$row = $ares->fetch_assoc();


// $total_registros = $ares->num_rows;
// $contador_dos = 0;
// while ($row = $ares->fetch_assoc()) {
//     if ($row['id_sta'] == 2) {
//         $contador_dos++;
//     }
// }

// if ($contador_dos == $total_registros && $total_registros > 0) {
//     // Todos los id_sta son 2 y hay registros
//     echo "error TODFOS";
// } else {
//     // Hay al menos un id_sta diferente de 2 o no hay registros
//     // ... resto del código para la actualización
//     echo "Existe uno por l menos"
// }

// if ($todosSonDos && $totalRegistros > 0) {
//     echo "ALERTA";
// } else {
//     echo "ACTUALIZO";
// //    $b="UPDATE datos_bancarios_med SET id_ban = '$id_ban', id_tip = '$id_tip_cuenta', 
// //    nro_cuenta = '$nro_cuenta', ach = '$ach', swit = '$swit', aba = '$aba', id_sta = $id_sta
// //    WHERE id = $id AND id_user = $id_user";
// //    $bres = $mysqli->query($b);
// //    if ($bres) {
// //        echo 1;
// //    } else {
// //        echo 3;
// //    }
// }



?>