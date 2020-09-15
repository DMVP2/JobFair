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
        <div class="col-md-5">
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
        <div class="col-md-5">
            <div class="form-group">

                <select class="form-control" name="niveles[]">
                    <option value="Básico" selected>Básico</option>
                    <option value="Intermedio">Intermedio
                    </option>
                    <option value="Avanzado">Avanzado</option>
                    <option value="Nativo">Nativo</option>
                </select>
            </div>
        </div>
    </div>
</div>