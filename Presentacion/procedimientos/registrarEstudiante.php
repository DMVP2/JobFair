<?php

session_start();

include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_ENTIDADES . 'Usuario.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_NEGOCIO . 'EnvioCorreo.php');


// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

print_r($_POST);

$tipoDocumento = $_POST['tipoDocumento'];
$documento = $_POST['documentoEstudiante'];
$correo = $_POST['correoEstudiante'] . "@unbosque.edu.co";
$semestre = $_POST['semestreEstudiante'];
$carrera = $_POST['carrera'];
$telefono = $_POST['telefonoEstudiante'];
$experiencia = $_POST['experienciaEstudiante'];
$nacimiento = $_POST['nacimientoEstudiante'];

$us = new Usuario();
$contraseña = $us->crearPassword();
$contraseña = md5($contraseña);

$envioCorreo = new EnvioCorreo();
$envioCorreo->prepararCorreo($correo, "Salchiqueso", $contraseña);
$envioCorreo->enviarCorreo();