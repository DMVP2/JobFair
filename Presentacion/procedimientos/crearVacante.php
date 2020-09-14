<?php


include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');


// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

print_r($_POST);

//header("Location: ../../index.php");