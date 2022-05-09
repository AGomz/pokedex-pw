<?php

include_once("config/conexion.php");
include_once('./acciones/generar_tabla_borrar.php');
include_once('./acciones/generar_tabla_modificar.php');

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
    $thModificar = $logueado ? "<th>Modificar</th>" : "";

    echo "<div class='w-75 mx-auto mt-5 mb-5'>
                <table class='table align-middle'>
                <thead class='table-dark'>
                <tr>
                    <th>Número</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Tipo</th>

                    $thBorrar
                    $thModificar

                 </tr>
                 </thead>";


    while ($row = $resultado->fetch_assoc()) {
        $numero =  $row['numero'];
        $nombre = $row['nombre'];
        $imagenPokemon = $row['imagen'];
        $imagenTipo = $row['img'];

        // Genera un html con una ventana modal de bootstrap para confirmar borrado
        $modalBorrar = $logueado ? $modalBorrar = generarCeldaModalBorrarPokemon($row['id']) : "";
        $botonModificar = $logueado ? $botonModificar = generarBotonModificar($row['id']) : "";

        echo "<tr class='table-light'>
                     <td>" .$numero . "</td>" .
            "<td><a href='mostrarDetallePokemon.php?id=$numero&nombr=$nombre&imgPokemon=$imagenPokemon&imgTipo=$imagenTipo'>" . $nombre . "</a></td>" .
            "<td><img width='90px' height='90px' src='./uploads/" . $imagenPokemon . "' alt='pokemon'/></td>" .
            "<td><img src='img/tipos/" . $imagenTipo . "' alt='tipo-pokemon'/></td>" .

            // Borrar pokemon sólo si esta logueado
            "$modalBorrar" .

            // Modificar pokemon sólo si esta logueado
            "$botonModificar" .

            "</tr>";
    }
    echo "</table>
             </div>";
}
/*Si no encuentra al pokemón, trae la lista de todos los pokemones*/
if($conexion->affected_rows<=0){

    $result = $conexion->query($consultaTodos);

    echo ("<h2 class='text-center' style='padding:2%'>Pokémon no encontrado :(</h2>
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
            $numero =  $filaAMostrar['numero'];
            $nombre = $filaAMostrar['nombre'];
            $imagenPokemon = $filaAMostrar['imagen'];
            $imagenTipo = $filaAMostrar['img'];

            echo "<tr class='table-light'>
                         <td>" . $numero . "</td>" .
                "<td><a href='mostrarDetallePokemon.php?id=$numero&nombr=$nombre&imgPokemon=$imagenPokemon&imgTipo=$imagenTipo'>" . $nombre . "</a></td>" .
                "<td><img width='100px' height='100px' src='./uploads/" . $imagenPokemon . "' alt='imagen-pokemon'></td>" .
                "<td><img width='70px' height='25px' src='img/tipos/" . $imagenTipo . "' alt='tipo'></td>" .
                "</tr>";
        }
    }
    echo "</table>
             </div>";
}

$conexion->close();
