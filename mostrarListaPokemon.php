<?php

include_once("config/conexion.php");
include_once('./acciones/generar_tabla_borrar.php');

$logueado = isset($_SESSION['logueado']) ? True : False;

$datoABuscar = isset($_GET['busqueda']) ? $_GET['busqueda'] : null;

$consultaConDato = "SELECT DISTINCT p.numero, p.nombre, p.imagen, t.img, p.id
                 FROM pokemon p INNER JOIN tipo t ON p.tipo1=t.id
                 WHERE t.nombre= ? OR p.nombre= ? OR p.numero= ? ";

$consultaTodos = "SELECT p.numero, p.nombre, p.imagen, t.img, p.id
                 FROM pokemon p JOIN tipo t ON p.tipo1=t.id";

if ($datoABuscar) {

    $comando = $conexion->prepare($consultaConDato);
    $comando->bind_param("ssi", $datoABuscar, $datoABuscar, $datoABuscar);
    $comando->execute();

    $resultado = $comando->get_result();
} else {
    $resultado = $conexion->query($consultaTodos);
    if ($resultado->num_rows == 0) {
        // Devuelve $comando = $conexion->prepare($consultaConDato);
        $comando->bind_param("ssi", $datoABuscar, $datoABuscar, $datoABuscar);
        $comando->execute();

        $resultado = $comando->get_result();
    }
}

if ($resultado->num_rows > 0) {
    $thBorrar = $logueado ? "<th>Borrar</th>" : "";

    echo "<div class='w-75 mx-auto mt-5 mb-5'>
                <table class='table align-middle'>
                <thead class='table-dark'>
                <tr>
                    <th>Número</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Tipo</th>

                    $thBorrar

                 </tr>
                 </thead>";


    while ($row = $resultado->fetch_assoc()) {

        // Genera un html con una ventana modal de bootstrap para confirmar borrado
        $modalBorrar = $logueado ? $modalBorrar = generarCeldaModalBorrarPokemon($row['id']) : "";

        echo "<tr class='table-light'>
                     <td>" . $row['numero'] . "</td>" .
            "<td>" . $row['nombre'] . "</td>" .
            "<td><img width='90px' height='90px' src='./uploads/" . $row['imagen'] . "' alt='pokemon'/></td>" .
            "<td><img src='img/tipos/" . $row['img'] . "' alt='tipo-pokemon'/></td>" .

            // Borrar pokemon sólo si esta logueado
            "$modalBorrar" .

            "</tr>";
    }
    echo "</table>
             </div>";
}

$conexion->close();
