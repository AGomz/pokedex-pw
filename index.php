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
    ?>
    <header>
        <!-- Menu principal -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.php">
                    <img src="./img/logo.png" alt="Logo Pókedex" class="d-inline-block align-text-top">
                    Pokédex
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample04">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <?php
                        $inicioSession = isset($_SESSION['logueado']) ? $_SESSION['logueado'] : null;
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

    <footer>

    </footer>
    <!-- Bootstrap funciones js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>