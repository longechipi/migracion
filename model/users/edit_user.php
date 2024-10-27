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
$a = "";