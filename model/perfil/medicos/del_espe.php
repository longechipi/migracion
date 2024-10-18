<?php 
require('../../../conf/conex.php');
require('../../../controller/log.php');

$id = $_POST['id'];
$idmed = $_POST['idmed'];
$b ="SELECT id_espe FROM medico_especialidad WHERE id = $id ";
$bres=$mysqli->query($b);
$brow=$bres->fetch_array();
$idespmed = $brow['id_espe'];
$a = ("DELETE FROM medico_especialidad WHERE id='$id' AND id_user = $idmed ");
//------ REGISTRO DE LOG -----//
register_log($mysqli, $idmed,'ELIMINO ESPECIALIDAD', 'PERFIL', 'USUARIO SE ELIMINO UNA ESPECIALIDAD MEDICA CON ID: '.$idespmed.'');
$ares=$mysqli->query($a);
echo $id;