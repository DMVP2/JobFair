<?php

include_once("../../../rutas.php");

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'manejoHojaDeVida.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoHojaVida = new ManejoHojaDeVida($conexion);

?>

<div class="divListId">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <input type="text" class="form-control" list="items" id="textCategoria[]" name="textCategoria[]" />
                <datalist id="items" id="dataCategoria[]" name="dataCategoria[]">
                    <?php

                    $listaCategorias = $manejoHojaVida->listarCategorias();

                    foreach ($listaCategorias as $categoria) {
                        echo "<option data-value=" . $categoria[0] . ">" . $categoria[1] . "</option>";
                    }

                    ?>
                </datalist>
            </div>
        </div>
    </div>
</div>