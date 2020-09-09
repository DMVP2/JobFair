<?php

session_start();

include_once('../../rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_NEGOCIO . 'ManejoEmpresa.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_NEGOCIO . 'ManejoUsuario.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_ENTIDADES . 'Empresa.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_ENTIDADES . 'Representante.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_ENTIDADES . 'Usuario.php');


// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoEmpresa = new ManejoEmpresa($conexion);
$manejoUsuario = new ManejoUsuario($conexion);


$nit = $_POST['nitEmpresa'];
$razonSocial = $_POST['razonSocial'];
$razonComercial = $_POST['razonComercial'];
$descripcion = $_POST['descripcionEmpresa'];
$beneficios = $_POST['otrosBeneficios'];
$logo = "ABC.png";

$empresa = new Empresa();
$empresa->setNit($nit);
$empresa->setRazonComercial($razonComercial);
$empresa->setRazonSocial($razonSocial);
$empresa->setDescripcion($descripcion);
$empresa->setOtrosBeneficios($beneficios);
$empresa->setLogoEmpresa($logo);
$empresa->setEstadoEmpresa("Activo");

$manejoEmpresa->crearEmpresa($empresa);


$arregloRepresentantes = $_POST['nombreRepresentante'];
$arregloCorreoRepre = $_POST['correoRepresentante'];
$arregloCargoRepre = $_POST['cargoRepresentante'];
$arregloTelefonoRepre = $_POST['telefonoRepresentante'];

$aux = 0;
foreach ($arregloRepresentantes as $actualRepresentante) {
    $representante = new Representante();
    $representante->setNombre($actualRepresentante);
    $representante->setCorreo($arregloCorreoRepre[$aux]);
    $representante->setcargo($arregloCargoRepre[$aux]);
    $representante->setTelefono($arregloTelefonoRepre[$aux]);

    $manejoEmpresa->crearRepresentante($representante, $nit);

    $aux = $aux + 1;
}



$usuario = $_POST['usuarioEmpresa'];


$us = new Usuario();
$us->setId($nit);
$us->setUsuario($usuario);
$us->setPassword(md5($_POST['contraseña']));
$us->setEstado("V");
$us->setRolUsuario("2");
$manejoUsuario->crearUsuario($us);