<?php
$pokemonId = isset($_GET['pokemonId']) ? $_GET['pokemonId'] : null;

if (!$pokemonId) {
    // Si no se manda pokemonId en la url volvemos al index
    header('Location: index.php');
    $conexion->close();
    die();
} else {
    // Busca el pokemon
    $query = "SELECT * FROM pokemon WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $pokemonId);
    $stmt->execute();

    $datos = $stmt->get_result();
    $fila = $datos->fetch_assoc();

    // Si no encuentra al pokemon volvemos al index
    if ($conexion->affected_rows == 0) {
        header('Location: index.php');
        $conexion->close();
        die();
    }
}
