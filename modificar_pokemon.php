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

//$pokemonId = isset($_GET['pokemonId']) ? $_GET['pokemonId'] : null;

include('./acciones/modificar_pokemon.php');
include('./acciones/obtener_pokemon.php');

?>
    <main>

    </main>
    <h1 class="text-center pt-4">Modificar un Pokemón</h1>

    <form action="./modificar_pokemon.php" method="POST" enctype="multipart/form-data" class="mx-5">
        <?php
        // Verifica si hubo errores al subir el archivo
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($error)) {
                echo "<div class='alert alert-danger' role='alert'>$error</div>";
            } else {
                echo "<div class='alert alert-info text-center' role='alert'>¡Pokemón modificado con éxito!</div>";
            }
        }
        ?>

        <input id="pokemonId" name="pokemonId" type="hidden" <?php echo "value=". $fila['id']?>>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                   placeholder="Nombre del pokemón" <?php echo "value=". $fila['nombre']?>>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Número identificador</label>
            <input type="number" class="form-control" id="identificador" name="identificador"
                   placeholder="Ingrese el número identificador del pokemón"
                   <?php echo "value=". $fila['numero']?>>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                      style="resize:none" maxlength="150"><?php echo $fila['descripcion']?></textarea>
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
                $tipos = $datos->fetch_all(MYSQLI_ASSOC);

                foreach ($tipos as $tipo) {
                    $idTipo = $tipo["id"];
                    $nombreTipo = $tipo["nombre"];
                    $isSelected = "";

                    if ($fila["tipo1"] == $tipo["id"])
                        $isSelected = 'selected';

                    echo "<option value=\"$idTipo\" $isSelected>$nombreTipo</option>";
                }

                ?>
            </select>
            <select class="form-select" name="tipo2">
                <option value="NULL">Seleccione tipo 2</option>";
                <?php
                foreach ($tipos as $tipo) {
                    $idTipo = $tipo["id"];
                    $nombreTipo = $tipo["nombre"];
                    $isSelected = "";

                    if ($fila["tipo2"] == $tipo["id"])
                        $isSelected = 'selected';

                    echo "<option value=\"$idTipo\" $isSelected>$nombreTipo</option>";
                }
                ?>
            </select>
        </div>

        <div class="mt-3">
            <label for="imagen" class="form-label">Modificar imagen</label>
            <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*"
                <?php echo "value=./uploads/". $fila['imagen']?> onchange="onFileSelected(event)">

            <img id="pokemonAvatar" height="200px" class="mt-2" alt="avatar"
                <?php echo "src=./uploads/". $fila['imagen']?>>
        </div>

        <button type="submit" class="btn btn-primary my-3">Modificar</button>
    </form>
<?php
include_once('./view/footer.php');
?>
