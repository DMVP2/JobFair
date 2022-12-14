<?php

include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoUsuario.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEmpresa.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEstudiante.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoUsuario = new ManejoUsuario($conexion);
$manejoEmpresa = new ManejoEmpresa($conexion);
$manejoEstudiante = new ManejoEstudiante($conexion);

$idUsuario = $_POST['codigoUsuario'];
$usuario = $manejoUsuario->buscarUsuario($idUsuario);
$rol = $usuario->getRolUsuario();

$estado = "Inactivo";

if (isset($_GET['op'])) {
    $estado = "Activo";
}
echo $rol;
if ($rol == 2) {
    $manejoEmpresa->actualizarEstado($idUsuario, $estado);
} else {
    $manejoEstudiante->actualizarEstado($idUsuario, $estado);
}


$manejoUsuario->modificarEstadoUsuario($idUsuario, $estado);


header("Location: " . CARPETA_RAIZ . RUTA_TABLAS . "tablaUsuario.php");