<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

    // Si vino por post va a intentar guardar el pokemon en la bd
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        include('./acciones/agregar_pokemon.php');
    }

    ?>
    <header>
        <!-- Menu principal -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="./img/logo.png" alt="Logo Pókedex" class="d-inline-block align-text-top">
                    Pokédex
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
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
        <!-- <div class="form-check">
            <input class="form-check-input" type="radio" name="tipoPokemon" id="tipoAire" value="AIRE" checked>
            <label class="form-check-label" for="tipoAire">
                Aire
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tipoPokemon" id="tipoAgua" value="AGUA">
            <label class="form-check-label" for="tipoAgua">
                Agua
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tipoPokemon" id="tipoFuego" value="FUEGO">
            <label class="form-check-label" for="tipoFuego">
                Fuego
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tipoPokemon" id="tipoTierra" value="TIERRA">
            <label class="form-check-label" for="tipoTierra">
                Tierra
            </label>
        </div> -->
        <div class="mt-3">
            <label for="imagen" class="form-label">Agregar una imagen</label>
            <input class="form-control" type="file" id="imagen" name="imagen">
        </div>

        <button type="submit" class="btn btn-primary my-3">Agregar</button>
    </form>

    <footer>

    </footer>
    <!-- Bootstrap funciones js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>