<?php 

function register_log($mysqli, $id_usuario, $accion,$modulo, $detalle) {
$a = "INSERT INTO logs (id_user, action, module, details, status)
VALUES ($id_usuario, '$accion', '$modulo', '$detalle', 'success')";
$ares= $mysqli->query($a);
return $ares;
mysqli_close($mysqli);
}

?>