<?php 
function registrar_login($usuario, $ip, $modulo) {
    $sql = "INSERT INTO logs (id_user, action, module, details, status)
VALUES (1, 'Login exitoso', 'auth', 'Credenciales válidas', 'success');";


    // //$stmt = $conn->prepare($sql);
    // $stmt->bind_param("sss", $usuario, $ip, $modulo);

    // // Ejecutar sentencia
    // if ($stmt->execute()) {
    //     echo "Login registrado exitosamente";
    // } else {
    //     echo "Error al registrar el login: " . $stmt->error;
    // }

    // // Cerrar sentencia
    // $stmt->close();
}


?>