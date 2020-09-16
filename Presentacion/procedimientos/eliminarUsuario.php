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

$manejoUsuario->eliminarUsuario($idUsuario);

if ($rol == 2) {
    //Eliminar empresa
    $manejoEmpresa->eliminarEmpresa($idUsuario);
} else {
    //Eliminar estudiante
    $manejoEstudiante->eliminarEstudiante($idUsuario);
}



header("Location: " . CARPETA_RAIZ . RUTA_TABLAS . "tablaUsuario.php");