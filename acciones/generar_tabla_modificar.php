<?php

function generarBotonModificar($id)
{
    return "
    <td>
        <a class='btn btn-warning btn-sm' href='./modificar_pokemon.php?pokemonId=$id' role='button'>Modificar</a>
    </td>";

}
