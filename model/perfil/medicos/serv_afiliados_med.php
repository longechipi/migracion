<?php 
require('../../../conf/conex.php');
require('../../../controller/log.php');
$id = $_POST['id'];
$idmed = $_POST['idmed'];

$sql = "SELECT id FROM medico_serv_afil WHERE id_ser='$id' AND id_med='$idmed'; ";
$objesp=$mysqli->query($sql);
$rowcounti=mysqli_num_rows($objesp);

if ($rowcounti>0) {
    $sql="DELETE FROM medico_serv_afil WHERE id_ser='$id' AND id_med='$idmed';";
    register_log($mysqli, $idmed,'ELIMINO SERVICIO', 'PERFIL', 'USUARIO ELIMINO UN SERVICIO ASOCIADO CON ID: ' .$id);
}else{
    $sql = "INSERT INTO medico_serv_afil(id_med, id_ser, id_sta) VALUES ($idmed, $id, 1)";
    register_log($mysqli, $idmed,'AGREGO SERVICIO', 'PERFIL', 'USUARIO AGREGO UN SERVICIO ASOCIADO CON ID: ' .$id);
}
 $conex=$mysqli->query($sql);