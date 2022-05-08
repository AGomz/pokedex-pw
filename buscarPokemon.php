<?php
include_once("view/header.php");
include_once("config/conexion.php");


$datoABuscar = $_POST["busqueda"];

/*Trae el pokemon por nombre/id, o el tipo que le pido*/
if($datoABuscar !=null){
    $consulta = "SELECT DISTINCT p.numero, p.nombre, p.imagen, img
                 FROM pokemon p INNER JOIN tipo t ON p.tipo1=t.id
                 WHERE t.nombre= ? OR p.nombre= ? OR p.numero= ? ";

    $comando = $conexion->prepare($consulta);
    $comando->bind_param("ssi", $datoABuscar, $datoABuscar, $datoABuscar);
    $comando->execute();

    $resultado = $comando->get_result();


    if($conexion->affected_rows>0) {
        echo "<h2 class='text-center mt-5 mb-5'>Resultados de la búsqueda:</h2>";
        echo "<div class='w-75 mx-auto mt-5 mb-5'>
                <table class='table align-middle'>
                <thead class='table-dark'>
                <tr>
                    <th>Número</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Tipo</th>
                 </tr>
                 </thead>";

        while ($filaAMostrar = $resultado->fetch_assoc()) {
            echo "<tr class='table-light'>
            <td>" . $filaAMostrar['numero'] . "</td>" .
                "<td>" . $filaAMostrar['nombre'] . "</td>" .
                "<td><img width='100px' height='100px' src='img/" . $filaAMostrar['imagen'] . "' alt='imagen-pokemon'></td>" .
                "<td><img width='70px' height='25px' src='img/tipos/" . $filaAMostrar['img'] . "' alt='tipo'></td>" .
                "</tr>";
        }
        echo "</table>
             </div>";
    }

    /*Si no encuentra al pokemón, trae la lista de todos los pokemones*/
    if($conexion->affected_rows<=0){
            $consulta = "SELECT DISTINCT p.numero, p.nombre, p.imagen, img
                 FROM pokemon p INNER JOIN tipo t ON p.tipo1=t.id";

            $result = $conexion->query($consulta);

            echo ("<h2 class='text-center' style='padding:3%'>Pokemón no encontrado :(</h2>
                    <h4 class='text-center' style='padding:1% 5%'>Podría interesarte:</h4>");
            echo "<div class='w-75 mx-auto mt-5 mb-5'>
                <table class='table align-middle'>
                <thead class='table-dark'>
                <tr>
                    <th>Número</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Tipo</th>
                 </tr>
                 </thead>";

            if($result->num_rows > 0){
                while($filaAMostrar = $result->fetch_assoc()){
                    echo "<tr class='table-light'>
                         <td>" . $filaAMostrar['numero'] . "</td>" .
                        "<td>" . $filaAMostrar['nombre'] . "</td>" .
                        "<td><img width='100px' height='100px' src='img/" . $filaAMostrar['imagen'] . "' alt='imagen-pokemon'></td>" .
                        "<td><img width='70px' height='25px' src='img/tipos/" . $filaAMostrar['img'] . "' alt='tipo'></td>" .
                        "</tr>";
                }
            }
            echo "</table>
             </div>";
        }
    }

    /*Si no busco nada, trae todos los pokemones*/
    if($datoABuscar==null){
        $consulta = "SELECT DISTINCT p.numero, p.nombre, p.imagen, img
                     FROM pokemon p INNER JOIN tipo t ON p.tipo1=t.id";

        $result = $conexion->query($consulta);

        echo "<h2 class='text-center mt-5 mb-5'>Mostrando pokemones...</h2>";

        echo "<div class='w-75 mx-auto mt-5 mb-5'>
                    <table class='table align-middle'>
                    <thead class='table-dark'>
                    <tr>
                        <th>Número</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Tipo</th>
                     </tr>
                     </thead>";

        if($result->num_rows > 0){
            while($filaAMostrar = $result->fetch_assoc()){
                echo "<tr class='table-light'>
                     <td>" . $filaAMostrar['numero'] . "</td>" .
                    "<td>" . $filaAMostrar['nombre'] . "</td>" .
                    "<td><img width='100px' height='100px' src='img/" . $filaAMostrar['imagen'] . "' alt='imagen-pokemon'></td>" .
                    "<td><img width='70px' height='25px' src='img/tipos/" . $filaAMostrar['img'] . "' alt='tipo'></td>" .
                    "</tr>";
            }
        }
        echo "</table>
                 </div>";
    }

$conexion->close();


include_once("view/footer.php");

