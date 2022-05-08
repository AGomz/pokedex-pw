<?php
include_once('./view/header.php');

include_once('./config/conexion.php');

// Si no esta iniciada la session lo mando al login
$inicioSession = isset($_SESSION['logueado']) ? $_SESSION['logueado'] : null;
if (!$inicioSession) {
    header('Location: login.php');
    $conexion->close();
    die();
}

// Si vino por post va a intentar guardar el pokemon en la bd
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include('./acciones/agregar_pokemon.php');
}

?>

<main>

</main>
<h1 class="text-center pt-4">Agregar un nuevo Pokemón</h1>

<form action="./agregar_pokemon.php" method="POST" enctype="multipart/form-data" class="mx-5">
    <?php
    // Verifica si hubo errores al subir el archivo
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($error)) {
            echo "<div class='alert alert-danger' role='alert'>$error</div>";
        } else {
            echo "<div class='alert alert-info' role='alert'>Nuevo Pokemón agregado</div>";
        }
    }
    ?>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del pokemón">
    </div>
    <div class="mb-3">
        <label for="nombre" class="form-label">Número identificador</label>
        <input type="text" class="form-control" id="identificador" name="identificador" placeholder="Ingrese el número identificador del pokemón">
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
    </div>
    <div>
        <label class="form-label">Seleccionar tipo(s)</label>
        <select class="form-select" name="tipo1">
            <?php
            include_once('./config/conexion.php');

            $query = "SELECT id, nombre FROM tipo";

            $stmt = $conexion->prepare($query);
            $stmt->execute();

            $datos = $stmt->get_result();
            $fila = $datos->fetch_all(MYSQLI_ASSOC);

            foreach ($fila as $tipo) {
                $idTipo = $tipo["id"];
                $nombreTipo = $tipo["nombre"];
                echo "<option value=\"$idTipo\">$nombreTipo</option>";
            }

            ?>
        </select>
        <select class="form-select" name="tipo2">
            <option value="NULL">Nulo</option>";
            <?php
            foreach ($fila as $tipo) {
                $idTipo = $tipo["id"];
                $nombreTipo = $tipo["nombre"];
                echo "<option value=\"$idTipo\">$nombreTipo</option>";
            }
            ?>
        </select>
    </div>
    <div class="mt-3">
        <label for="imagen" class="form-label">Agregar una imagen</label>
        <input class="form-control" type="file" id="imagen" name="imagen"
               accept="image/*" onchange="onFileSelected(event)">

        <img id="pokemonAvatar" height="200px" class="mt-2" alt="avatar"
             src="img/pokemon-placeholder.jpeg">
    </div>

    <button type="submit" class="btn btn-primary my-3">Agregar</button>
</form>

<?php
include_once('./view/footer.php');
?>