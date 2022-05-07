
<?php

// Obtener los datos enviados por el formulario
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$numero = isset($_POST['identificador']) ? $_POST['identificador'] : null;
$tipo1 = isset($_POST['tipo1']) ? $_POST['tipo1'] : null;
$tipo2 = isset($_POST['tipo2']) ? $_POST['tipo2'] : null;

// Verifica si el usuario subio una imagen o no
$imagen = ($_FILES['imagen']['size'] != 0) ? $_FILES['imagen'] : null;

if (!$nombre || !$descripcion || !$numero || !$tipo1 || !$tipo2) {
    $error = "Debe completar todos los campos requeridos";
} else {
    // Agregar a la base de datos

    // Si no tiene tipo 2, inserta null
    if ($tipo2 === 'NULL') {
        $tipo2 = null;
    }

    $query = "INSERT INTO pokemon(numero, nombre, descripcion, tipo1, tipo2) VALUES (?,?,?,?,?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('issii', $numero, $nombre, $descripcion, $tipo1, $tipo2);
    $stmt->execute();

    // Subir el archivo al servidor si existe el usuario agrego una imagen
    // Se guarda en la carpeta /uploads/{idPokemonEnLaDB}.{extensionDeLaImagen}
    if ($imagen) {
        // Obtiene la extension del archivo *.jpg, *.gif, etc
        $extensionArchivo = pathinfo($imagen['name'], PATHINFO_EXTENSION);

        $ultimoId = $conexion->insert_id;
        $ruta_imagen = "./uploads/$ultimoId.$extensionArchivo";
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);

        // Se actualiza el campo con la ruta de la imagen recien subida
        $stmt->close();
        $query = "UPDATE pokemon SET imagen = ? WHERE id = ?";
        $stmt = $conexion->prepare($query);

        $stmt->bind_param("si", $ruta_imagen, $ultimoId);
        $stmt->execute();
    }
}
