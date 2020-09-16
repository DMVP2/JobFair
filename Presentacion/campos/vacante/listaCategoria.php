<?php

include_once("../../../rutas.php");

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoVacante.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoVacante = new manejoVacante($conexion);

?>

<div class="divListId">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="bmd-label-floating">Categoria:</label>
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <select class="form-control" id="dataCategoria[]" name="dataCategoria[]">
                    <?php

                    $listaCategorias = $manejoVacante->listarCategorias();

                    foreach ($listaCategorias as $categoria) {
                        echo "<option value=" . $categoria[0] . ">" . $categoria[1] . "</option>";
                    }

                    ?>
                </select>
            </div>
        </div>
    </div>
</div>