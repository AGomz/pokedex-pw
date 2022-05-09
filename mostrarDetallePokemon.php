<?php
include_once("view/header.php");
include_once("config/conexion.php");

$id = $_GET["id"];
$nombre = $_GET["nombr"];
$imagenPokemon = $_GET["imgPokemon"];
$imagenTipo = $_GET["imgTipo"];


$consulta = "SELECT DISTINCT descripcion
                 FROM pokemon p INNER JOIN tipo t ON p.tipo1=t.id
                 WHERE p.numero=? AND p.nombre=?";

$comando = $conexion->prepare($consulta);
$comando->bind_param("is", $id, $nombre);
$comando->execute();

$resultado = $comando->get_result();

if($conexion->affected_rows>0) {
    echo "<div class='container'>
        <div>
            <img src='./uploads/" . $imagenPokemon . "' class='img-pokemon' alt='pokemon'>
        </div>
        <div>
            <h1 class='nombre'>". $nombre . "</h1>
            <p>Número:". $id . " </p>
            <p>Tipo: <img src='img/tipos/" . $imagenTipo . "' alt='tipo-pokemon'></p>";

    while ($filaAMostrar = $resultado->fetch_assoc()) {
        $descripcion = $filaAMostrar["descripcion"];
        echo "<p>". $descripcion . "</p>";
    }
    echo "</div>      
    </div>";
}

$conexion->close();

include_once("view/footer.php");
