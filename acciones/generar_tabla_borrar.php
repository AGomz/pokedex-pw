<?php

function generarCeldaModalBorrarPokemon($id)
{
    return <<<EOF
    <td>
    <form action="./acciones/borrar_pokemon.php" method="POST">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal$id">
      Borrar
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal$id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Borrar Pokemón</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ¿Realmente desea borrar el Pokemón?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger" value="$id" name="pokemonId">Borrar</button>
          </div>
        </div>
      </div>
    </div> 
    </form>
    </td>
    EOF;
}
