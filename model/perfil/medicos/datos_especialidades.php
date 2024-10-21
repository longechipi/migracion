<?php 
require('../../../conf/conex.php');
require('../../../controller/log.php');
//------- ID MEDICO Y ESPECIALIDAD -------//
$idespmed = $_POST['idespmed'];
$idmed = $_POST['idmed'];

$a="SELECT id_user, id_espe FROM medico_especialidad WHERE id_user = $idmed AND id_espe = $idespmed";
$ares=$mysqli->query($a); 
$rowcounti=mysqli_num_rows($ares);
if ($rowcounti>0) {
    //------ Lanza Error si ya la tiene Incluida -----//
    echo '2';
}else{
    //------- Graba la Informacion -----//
    $b = "INSERT INTO medico_especialidad(id_user, id_espe, id_sta)VALUES($idmed, $idespmed, 1)";
    $bres=$mysqli->query($b);
    
    $c = "SELECT ME.id_espe, EM.especialidad 
    FROM medico_especialidad ME
    INNER JOIN especialidades_med EM ON ME.id_espe = EM.id_espe
    WHERE ME.id = LAST_INSERT_ID();";
    $cres=$mysqli->query($c);
    $rowc=mysqli_fetch_array($cres);
    //------ REGISTRO DE LOG -----//
    register_log($mysqli, $idmed,'CREO ESPECIALIDAD', 'PERFIL', 'USUARIO SE ASIGNO UNA NUEVA ESPECIALIDAD MEDICA CON ID: '.$idespmed.'');
    echo $rowc['id_espe'] .'-' .$rowc['especialidad'];
}
?>