    <?php
    include_once('./view/header.php');

    include_once('./config/conexion.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        include('./acciones/login.php');
    }
    ?>

    <main>
        <div class="container-fluid min-vh-100">
            <div class="row justify-content-md-center align-items-center vh-100">
                <div class="col-md-4 bg-light shadow p-4 mb-5 rounded border border-secondary">
                    <h2 class="text-center pb-3">
                        <img src="./img/logo.png" alt="Logo Pókedex">
                        Pokédex - Login
                    </h2>
                    <?php
                    // Verifica si hay errores en el login
                    if (isset($error)) {
                        echo "<div class='alert alert-danger' role='alert'>$error</div>";
                    }
                    ?>
                    <form action="./login.php" method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Contraseña" name="password">
                        </div>
                        <input class="btn btn-primary" type="submit" value="Ingresar">
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php
    include_once('./view/footer.php');
    ?>