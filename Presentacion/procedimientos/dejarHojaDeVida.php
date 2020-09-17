<?php

include_once('../../rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEmpresa.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoEmpresa = new ManejoEmpresa($conexion);

$idEstudiante = $_SESSION['usuario'];
$nitEmpresa = $_POST['idEmpresa'];

$manejoEmpresa->aplicarEstudianteEmpresa($nitEmpresa, $idEstudiante);


header("Location: " . CARPETA_RAIZ . RUTA_INFORMACION . 'listadoEmpresas.php');