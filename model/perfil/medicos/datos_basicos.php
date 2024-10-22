<?php 
require('../../../conf/conex.php');
require('../../../controller/log.php');


//------ Id del USER -------//
$id_user = trim($_POST['id_user']);
//------ Datos Personales -------//
$apellido1 = strtoupper(trim($_POST['apellido1']));
$apellido2 = strtoupper(trim($_POST['apellido2']));
$nombre1 = strtoupper(trim($_POST['nombre1']));
$nombre2 = strtoupper(trim($_POST['nombre2']));
$tprif = trim($_POST['tprif']);
$rif = trim($_POST['rif']);
$rif_comp = $tprif . "" . $rif;
$fnacimiento = trim($_POST['fnacimiento']);
$edad = trim($_POST['edad']);
$idsexo = trim($_POST['idsexo']);
$idestcivil = trim($_POST['idestcivil']);
$celular_error =  filter_var(trim($_POST['celular']), FILTER_SANITIZE_NUMBER_INT);
$celular = preg_replace('/[^0-9]/', '', $celular_error);
$telefono_error = filter_var(trim($_POST['telefono']), FILTER_SANITIZE_NUMBER_INT);
$telefono = preg_replace('/[^0-9]/', '', $telefono_error);
$correo = trim($_POST['correo']);
$correoalt = trim($_POST['correoalt']);
$idpais = trim($_POST['idpais']);
$idestado = trim($_POST['idestado']);
$idmunicipio = trim($_POST['idmunicipio']);
$idparroquia = trim($_POST['idparroquia']);
$direccion = strtoupper(trim($_POST['direccion']));
$cod_col_med = trim($_POST['codcolemed']);
$mpss = trim($_POST['mpsscod']);

$a="UPDATE medicos SET nombre1='$nombre1', nombre2='$nombre2', apellido1='$apellido1', apellido2='$apellido2', rif='$rif_comp', fec_nac='$fnacimiento',edad='$edad',idsex='$idsexo', idcivil='$idestcivil',celular='$celular',telf='$telefono',correo_pri='$correo',correo2='$correoalt',idpais='$idpais',idestado='$idestado',idmunicipio='$idmunicipio',idparroquia='$idparroquia',direccion='$direccion', cod_col_med = '$cod_col_med', mpss = '$mpss' 
WHERE id_user = $id_user";
$ares=$mysqli->query($a);
    if($ares){
        register_log($mysqli, $id_user,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO ACTUALIZO INFORMACION DE DATOS BASICOS');
        echo "1";
    }else{
        echo "0";
    }
?>