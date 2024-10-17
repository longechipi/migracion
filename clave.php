<?php 


$clave = 123;

$hash = password_hash($clave, PASSWORD_DEFAULT);

echo $hash;





?>