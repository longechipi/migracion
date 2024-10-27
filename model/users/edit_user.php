<?php 
require('../../conf/conex.php');
require('../../controller/log.php');

$id_user = $_POST['id_user'];
$usuario = strtoupper(trim($_POST['usuario']));
$nom_user = strtoupper(trim($_POST['nom_user']));
$ape_user = strtoupper(trim($_POST['ape_user']));

$privi = strtoupper(trim($_POST['privi']));
$sta_user = strtoupper(trim($_POST['sta_user']));

//---- Actualiza Tabla Users ----//
$a = "UPDATE users SET nombre= '$nom_user', apellido = '$ape_user' WHERE id_user = $id_user";
$ares = $mysqli->query($a);
if($ares){
    register_log($mysqli, $id_user,'ACTUALIZO DATOS', 'USUARIOS', 'USUARIO ACTUALIZO NOMBRE Y APELLIDO DEL ID: '.$id_user.'');
    //---- Actualiza Tabla Privilegios ----//
    $b = "UPDATE users_privilegios SET id_pri = $privi WHERE id_user = $id_user";
    $bres = $mysqli->query($b);
    if($bres){
        register_log($mysqli, $id_user, 'ACTUALIZO DATOS', 'USUARIOS', 'USUARIO ACTUALIZO PRIVILEGIOS AL NIVEL('.$privi.') DEL ID: '.$id_user.'');
        $c = "UPDATE users_status SET id_sta = $sta_user WHERE id_user = $id_user ";
        $cres = $mysqli->query($c);
        if($cres){
            echo 1;
            register_log($mysqli, $id_user, 'ACTUALIZO DATOS', 'USUARIOS', 'USUARIO ACTUALIZO ESTATUS AL NIVEL('.$sta_user.') DEL ID: '.$id_user.'');
           
        }else{
            echo 0;
        }
    }else{
        echo 0;
    }
}else{
    echo 0;
}