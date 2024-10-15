<?php 
include('../layouts/header.php');
require('../conf/conex.php');

session_start();
echo "loggedin: " . $_SESSION['loggedin']; // Usuario autenticado
echo "id_user: " . $_SESSION['id_user'];
echo "id_pri: " . $_SESSION['id_pri'];
?>
HOLA TODO BIEN 
</body>
</html>