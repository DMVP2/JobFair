<?php

session_start();

include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoUSuario.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'Usuario.php');


// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$contraseña = md5($_POST['contraseña1']);
$idUsuario = $_SESSION['usuario'];

$manejoUsuario = new ManejoUsuario($conexion);

$manejoUsuario->cambiarContraseñaUsuario($idUsuario, $contraseña);

header("Location: " . CARPETA_RAIZ . RUTA_PORTALES . 'portalEstudiante.php');