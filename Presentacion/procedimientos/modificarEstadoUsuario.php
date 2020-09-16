<?php

include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoUsuario.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();


$manejoUsuario = new ManejoUsuario($conexion);

$idUsuario = $_POST['codigoUsuario'];


$estado = "Inactivo";
if (isset($_GET['op'])) {
    $estado = "Activo";
}



$manejoUsuario->modificarEstadoUsuario($idUsuario, $estado);


header("Location: " . CARPETA_RAIZ . RUTA_TABLAS . "tablaUsuario.php");