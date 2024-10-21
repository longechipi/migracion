<?php 
require('../../../conf/conex.php');
require('../../../controller/log.php');

$idmed = $_POST['idmed_hora'];
$idclinica = $_POST['idclinica'];
$consultorio = trim($_POST['consultorio']);
$piso = trim($_POST['piso']);

$telefono1_error =  filter_var(trim(trim($_POST['telefono1'])), FILTER_SANITIZE_NUMBER_INT);
$telefono1 = preg_replace('/[^0-9]/', '', $telefono1_error);
$telefono2_error =  filter_var(trim(trim($_POST['telefono2'])), FILTER_SANITIZE_NUMBER_INT);
$telefono2 = preg_replace('/[^0-9]/', '', $telefono2_error);
$pacxdia = trim($_POST['pacxdia']);
$pacconseg = trim($_POST['pacconseg']);
$pacsinseg = trim($_POST['pacsinseg']);

$horariosJSON = $_POST['horarios'];
$horarios = json_decode($horariosJSON, true);


 //--------- INSERTO PRIMERO EN CLINICAS DONDE TRABAJA ---------//
 $b="INSERT INTO medico_clinicas(id_cli, id_med, pac_dia, pac_aseg, 
 pac_part, consul, piso, telf1, telf2, id_sta)
 VALUES($idclinica, $idmed, $pacxdia, $pacconseg, $pacsinseg, '$consultorio', '$piso', '$telefono1', '$telefono2', 1 )";
 $bres=$mysqli->query($b);
 register_log($mysqli, $idmed,'REGISTRO CLINICA', 'PERFIL', 'USUARIO SE ASIGNO UNA CLINICA EN SU PERFIL DE TRABAJO CON ID: '.$idclinica.'');

foreach ($horarios as $horario) {
    //------ VALIDA CLINICA Y HORARIO -------//
    $dias = $horario['dias'];
    $desde = $horario['desde'];
    $hasta = $horario['hasta'];

    $a="SELECT * FROM medico_horario WHERE id_med = $idmed 
    AND dia = '$dias' 
    AND desde BETWEEN '$desde' AND '$hasta'";
    $ares=$mysqli->query($a);
    $count = mysqli_num_rows($ares);
    if ($count > 0) {
        //------ Lanza Error si ya la tiene Incluida -----//
        echo "2";
        exit;
    }else{

        //--------- INSERTO HORARIOS ---------//
        $c="INSERT INTO medico_horario(id_cli, id_med, dia, desde, hasta, id_sta)
        VALUES ($idclinica, $idmed, '$dias','$desde','$hasta', 1)";
        $cres=$mysqli->query($c);
        register_log($mysqli, $idmed,'REGISTRO HORARIO', 'PERFIL', 'USUARIO SE ASIGNO UN NUEVO HORARIO EN LA CLINICA CON ID: '.$idclinica.' Y HORARIO: '.$dias .' - '. $desde.' - '.$desde);
        
    }
}
echo "1";







?>