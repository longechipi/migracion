<?php 
require('../../../conf/conex.php');
require('../../../controller/log.php');

$id = $_POST['id'];
$idmed = $_POST['idmed'];

$a = "DELETE FROM medico_clinicas WHERE id = $id AND id_med = $idmed";
$ares=$mysqli->query($a);
register_log($mysqli, $idmed,'ELIMINO CLINICA', 'PERFIL', 'USUARIO ELIMINIO UN LUGAR DE TRABAJO (Clinica)');
$b="DELETE FROM medico_horario WHERE id = $id AND id_med = $idmed";
$bres=$mysqli->query($b);
register_log($mysqli, $idmed,'ELIMINO HORARIO', 'PERFIL', 'USUARIO ELIMINIO HORARIO RELACIONADO A LA CLINICA DONDE TRABAJA');
echo $id;