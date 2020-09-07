<?php

session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/softlutions/Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_NEGOCIO . 'manejoHojaDeVida.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$idUsuario = 1107064047;

$manejoHojaVida = new ManejoHojaDeVida($conexion);



//$manejoHojaVida->limpiarDatosHojaVida($idUsuario);