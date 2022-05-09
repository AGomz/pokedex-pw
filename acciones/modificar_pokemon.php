<?php

// Se actualizan los datos del pokemon en la bd
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener los datos enviados por el formulario
    $pokemonId = isset($_POST['pokemonId']) ? $_POST['pokemonId'] : null;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
    $identificador = isset($_POST['identificador']) ? $_POST['identificador'] : null;
    $tipo1 = isset($_POST['tipo1']) ? $_POST['tipo1'] : null;
    $tipo2 = isset($_POST['tipo2']) ? $_POST['tipo2'] : null;

    // Si no tiene tipo 2, inserta null
    if ($tipo2 === 'NULL') {
        $tipo2 = null;
    }

    // Verifica si el usuario subio una imagen o no
    $imagen = ($_FILES['imagen']['size'] != 0) ? $_FILES['imagen'] : null;

    if (!$nombre || !$descripcion || !$identificador || !$tipo1) {
        $error = "Debe completar todos los campos requeridos";
    } else {
        // Actualiza el pokemon en la base de datos
        $query = "UPDATE pokemon SET numero = ?, nombre = ?, descripcion = ?, tipo1 = ?, tipo2 = ?
                        WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param('issiii', $identificador, $nombre, $descripcion, $tipo1, $tipo2, $pokemonId);
        $result = $stmt->execute();

        // Subir el archivo al servidor si existe el usuario agrego una imagen
        // Se guarda en la carpeta /uploads/{idPokemonEnLaDB}.{extensionDeLaImagen}
        if ($imagen) {
            // Obtiene la extension del archivo *.jpg, *.gif, etc
            $extensionArchivo = pathinfo($imagen['name'], PATHINFO_EXTENSION);

            $ruta_imagen = "$pokemonId.$extensionArchivo";
            $ruta_destino = "./uploads/$ruta_imagen";

//            if (file_exists($ruta_destino)) {
//                chmod($ruta_destino,0755); //Change the file permissions if allowed
//                unlink($ruta_destino); //remove the file
//            }

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);

            // Se actualiza el campo con la ruta de la imagen recien subida
            $stmt->close();
            $query = "UPDATE pokemon SET imagen = ? WHERE id = ?";
            $stmt = $conexion->prepare($query);

            $stmt->bind_param("si", $ruta_imagen, $pokemonId);
            $result = $stmt->execute();
        }
    }
}
