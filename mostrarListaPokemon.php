<?php

include_once("config/conexion.php");

$consulta = "SELECT p.numero, p.nombre, p.imagen, t.img
                 FROM pokemon p JOIN tipo t ON p.tipo1=t.id
                    WHERE t.nombre='planta';";

$resultado = $conexion->query($consulta);

if($resultado->num_rows > 0){
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

    while($row = $resultado->fetch_assoc()){
        echo "<tr class='table-light'>
                     <td>" . $row['numero'] . "</td>".
            "<td>" . $row['nombre'] . "</td>".
            "<td><img width='90px' height='90px' src='img/".$row['imagen']."' alt='pokemon'/></td>".
            "<td><img src='img/tipos/".$row['img']."' alt='tipo-pokemon'/></td>".

            "</tr>";
    }
    echo "</table>
             </div>";
}

$conexion->close();