<?php 
require('../../../conf/conex.php');
require('../../../controller/log.php');

$id = $_POST['id'];
$idmed = $_POST['idmed'];
$a = "SELECT nom_docum, tip_docum FROM medico_documentos WHERE id = $id AND id_med = $idmed";
$result = $mysqli->query($a);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ruta_imagen = $row['nom_docum'];
    $tipo_documento = $row['tip_docum'];
    unlink('../../../upload/perfil_medico/' . $ruta_imagen);
    $a = "DELETE FROM medico_documentos WHERE id = $id AND id_med = $idmed";
    $ares = $mysqli->query($a);
    if ($ares) {
        echo '1';
        register_log($mysqli, $idmed,'ELIMINO DOCUMENTO', 'PERFIL', 'USUARIO ELIMINO UN DOCUMENTO DE TIPO: '.$tipo_documento.'');
    } else {
        echo '2';
    }
} else {
    echo '3';
}