<?php

include_once('../../rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoVacante.php');

print_r($_POST);

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoVacante = new manejoVacante($conexion);

$opcion = $_GET['a'];


if ($opcion == 1) {
    $idVacante = $_POST['idVacante1'];
    $idEstudiante = $_POST['docEstudiante1'];
    $manejoVacante->aprobarEstudiante($idVacante, $idEstudiante);
} else {
    $idVacante = $_POST['idVacante2'];
    $idEstudiante = $_POST['docEstudiante2'];
    $razon = $_POST['razon'];
    $manejoVacante->rechazarEstudiante($idVacante, $idEstudiante, $razon);
}


header("Location: " . CARPETA_RAIZ . RUTA_TABLAS . "tablaPostulaciones.php");