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
        <div class="col-md-6">
            <div class="form-group">
                <select class="form-control" name="idiomas[]">
                    <?php

                    $listaIdiomas = $manejoHojaVida->listarIdiomas();

                    foreach ($listaIdiomas as $idiomaActual) {
                        echo "<option value=" . $idiomaActual[0] . ">" . $idiomaActual[1] . "</option>";
                    }

                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">

                <select class="form-control" name="niveles[]">
                    <option value="A1" selected>A1</option>
                    <option value="A2">A2</option>
                    <option value="B1">B1</option>
                    <option value="B2">B2</option>
                    <option value="C1">C1</option>
                    <option value="C2">C2</option>
                </select>
            </div>
        </div>
    </div>
</div>