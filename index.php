<?php
include_once('./view/header.php');
?>

<!--Búsqueda-->
<nav class="navbar navbar-light bg-light nav-busqueda ">
    <div class="container-fluid justify-content-center">
        <span class="navbar-text me-2">Buscador:</span>
        <form id="buscar" class="d-flex w-75" action="index.php" method="GET">
            <input class="form-control me-2" type="text" name="busqueda" placeholder="Ingrese nombre, tipo o id" aria-label="Search">
            <input type="submit" class="btn btn-outline-dark" value="Buscar">
        </form>
    </div>
</nav>
<h1 class="titulo">Pokédex</h1>
<?php
include_once("mostrarListaPokemon.php");
?>

<main>

</main>


<?php
include_once('./view/footer.php');
?>