<?php

include_once('../../rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEmpresa.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'Empresa.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoEmpresa = new ManejoEmpresa($conexion);

$razonSocial = $_POST['razonSocial'];
$razonComercial = $_POST['razonComercial'];
$descripcion = $_POST['descripcionEmpresa'];
$beneficios = $_POST['otrosBeneficios'];

$nitEmpresa = $_SESSION['usuario'];

$empresa = new Empresa();
$empresa->setNit($nitEmpresa);
$empresa->setRazonComercial($razonComercial);
$empresa->setRazonSocial($razonSocial);
$empresa->setDescripcion($descripcion);
$empresa->setOtrosBeneficios($beneficios);

$manejoEmpresa->actualizarEmpresa($empresa);


header("Location: " . CARPETA_RAIZ . RUTA_PORTALES . 'portalEmpresa.php');