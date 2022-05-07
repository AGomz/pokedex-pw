<?php

// Obtener datos enviados por post
$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if (!$email || !$password) {
    $error = 'El usuario y password no puede estar vacío';
} else {
    $query = "SELECT usuario, password FROM usuario WHERE email = ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $datos = $stmt->get_result();
    $fila = $datos->fetch_assoc();

    if ($conexion->affected_rows > 0 && password_verify($password, $fila['password'])) {
        // Login correcto - generar la session
        $_SESSION['logueado'] = $fila['usuario'];

        header('Location: index.php');
        die();
    } else {
        // No lo encontró, no existe o contraseña incorrecta
        $error = 'Usuario y/o password inválidos';
    }
}
