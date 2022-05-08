<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script type="text/javascript" src="js/cargar_imagen.js"></script>
    <title>Pokédex</title>
</head>

<body>
    <?php
    session_start();

    include_once('./config/conexion.php');

    // Si no esta iniciada la session lo mando al login
    $inicioSession = isset($_SESSION['logueado']) ? $_SESSION['logueado'] : null;
    if (!$inicioSession) {
        header('Location: login.php');
        $conexion->close();
        die();
    }

    $pokemonId = isset($_GET['pokemonId']) ? $_GET['pokemonId'] : null;

    include('./acciones/modificar_pokemon.php');
    include('./acciones/obtener_pokemon.php');

    ?>
    <header>
        <!-- Menu principal -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="./img/logo.png" alt="Logo Pókedex" class="d-inline-block align-text-top">
                    Pokédex
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04"
                        aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample04">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <?php
                        if ($inicioSession) {
                            ?>
                            <!-- Esta logueado  -->
                            <li class="nav-item">
                                <a class="nav-link" href="./agregar_pokemon.php">Agregar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Modificar</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <ul class="navbar-nav mr-auto mb-2 mb-md-2">
                        <?php
                        if ($inicioSession) {
                            ?>
                            <!-- Esta logueado -->
                            <li class="nav-item px-2">
                                    <span class="text-white fw-bold">
                                        <?php echo strtoupper($_SESSION['logueado']); ?>
                                    </span>
                                <a class="btn btn-primary btn-sm" href="./acciones/logout.php">Logout</a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <!-- No esta logueado -->
                            <li class="nav-item px-2">
                                <a class="btn btn-secondary btn-sm" href="login.php">Login</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="btn btn-primary btn-sm" href="registro.php">Registrarse</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

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
                <?php echo "value=./img/". $fila['imagen']?> onchange="onFileSelected(event)">

            <img id="pokemonAvatar" height="200px" class="mt-2" alt="avatar"
                <?php echo "src=./img/". $fila['imagen']?>>
        </div>

        <button type="submit" class="btn btn-primary my-3">Modificar</button>
    </form>

    <footer>

    </footer>
    <!-- Bootstrap funciones js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    </body>

</html>
