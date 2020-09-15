<?php

include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'manejoVacante.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoVacante = new ManejoVacante($conexion);

$idEstudiante = $_SESSION['usuario'];
$idVacante = $_GET['vacante'];

$manejoVacante->aplicarVacanteEstudiante($idVacante, $idEstudiante);

header("Location: " . CARPETA_RAIZ . RUTA_INFORMACION . 'listadoVacantes.php');