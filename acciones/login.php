<?php
session_start();

include_once('../config/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener datos enviados por post
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if(!$usuario || !$password) {
        volverALogin();
    }

    $query = "SELECT usuario, password FROM usuario WHERE usuario = ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $usuario);
    
    $stmt->execute();

    $datos = $stmt->get_result();
    $fila = $datos->fetch_assoc();

    if($conexion->affected_rows > 0) {
        // Encontró al usuario, tengo que verificar password
        $hash = $fila['password'];

        // Comparo la contraseña que mando por post con el hash que hay en la bd
        if(password_verify($password, $hash)) {
            // Login correcto - generar la session
            $_SESSION['logueado'] = $usuario;
            
            header('Location: ../index.php');

        } else {
            // Login incorrecto
            volverALogin();
        }

    } else {
        // No existe el usuario
        volverALogin();
    }

} else {
    // No permitdo si no es POST
    volverALogin();
}

function volverALogin() {
    header('Location: ../login.html');
    $conexion->close();
    die();
}

?>