<?php

include_once('../config/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = isset($_POST['pokemonId']) ? $_POST['pokemonId'] : null;

    // Verifico si tiene foto
    $query = "SELECT imagen FROM pokemon WHERE id = ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $datos = $stmt->get_result();
    $fila = $datos->fetch_assoc();
    $imagen = isset($fila['imagen']) ? $fila['imagen'] : null;

    if ($conexion->affected_rows > 0) {
        $ruta_imagen = '../uploads/' . $imagen;

        if ($imagen && file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
        }
    }

    // Ahora borro el pokemon de la db
    $stmt->close();

    $query = "DELETE FROM pokemon WHERE id = ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Regrersar al index
    header('Location: ../index.php');
    die();
}

// Regrersar al index
header('Location: ../index.php');
die();
