<?php

function generarCeldaModalBorrarPokemon($id)
{
    $html = <<<EOF
    <td>
    <form id="$id" action="./acciones/borrar_pokemon.php" method="POST">
        <button class="btn btn-danger btn-sm"name="pokemonId" type="submit" value="$id">Borrar</button>
    </form>
    </td>
    EOF;
    return $html;
}
