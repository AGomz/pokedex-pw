<?php

// Obtener datos enviados por post
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;

// Valido que los valores no sean nulos
if (!$usuario || !$password || !$email) {

    $error = 'Todos los campos deben estar completados';
} else {
    // Verificar que el email no exista en la base de datos
    $query = "SELECT email FROM usuario WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $datos = $stmt->get_result();
    $fila = $datos->fetch_assoc();

    // No se permiten usuarios con igual email
    if ($conexion->affected_rows > 0) {
        $error = "El email ${fila['email']} ya existe";
    } else {
        // Cierra la consulta anterior para reutilizar
        $stmt->close();

        // Si no encontró el email, se puede registrar al nuevo usuario

        // Crear el hash para la password del usuario
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuario(usuario, password, email) VALUES (?, ? ,?)";

        // Ejecutar la consulta
        $stmt = $conexion->prepare($query);
        $stmt->bind_param('sss', $usuario, $hash, $email);
        // Ejecuta el INSERT en la DB
        $stmt->execute();

        // Registro exitoso, redirijo a login
        header('Location: login.php');
        $conexion->close();
        die();
    }
}
