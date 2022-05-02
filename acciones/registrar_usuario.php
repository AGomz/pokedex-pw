<?php

include_once('../config/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener datos enviados por post
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    // Valido que los valores no sean nulos
    if( !$usuario || !$password || !$email) {
        volverARegistro();
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO usuario(usuario, password, email) VALUES (?, ? ,?)";

    // Ejecutar la consulta
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('sss', $usuario, $hash, $email);

    if($stmt->execute()) {
        // Registro exitoso
        header('Location: ../index.php');
        $conexion->close();
        die();

    } else {
        // Falla
        // Redirigir y avisar error
        volverARegistro();
    }

} else {
    // Si no es por post vuelvo al registro
    volverARegistro();
}

function volverARegistro() {
    header('Location: ../registro.html');
    $conexion->close();
    die();
}

?>