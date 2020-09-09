<?php

session_start();

include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_PARAMETRIZACION_CORREO);

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_NEGOCIO . 'ManejoEstudiante.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_NEGOCIO . 'ManejoUSuario.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_ENTIDADES . 'Estudiante.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_ENTIDADES . 'Usuario.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . CARPETA_RAIZ . RUTA_NEGOCIO . 'EnvioCorreo.php');


// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoEstudiante = new ManejoEstudiante($conexion);
$manejoUsuario = new ManejoUsuario($conexion);

$correo = $_POST['correoEstudiante'];


$tipoDocumento = $_POST['tipoDocumento'];
$documento = $_POST['documentoEstudiante'];
$correoIns = $correo . "@unbosque.edu.co";
$nombre = $_POST['nombreEstudiante'];
$semestre = $_POST['semestreEstudiante'];
$carrera = $_POST['carrera'];
$telefono = $_POST['telefonoEstudiante'];
$experiencia = $_POST['experienciaEstudiante'];
$nacimiento = $_POST['nacimientoEstudiante'];

$nuevoEstudiante = new Estudiante();
$us = new Usuario();

$contraseña = $us->crearPassword();
$contraseñaCifrada = md5($contraseña);

$nuevoEstudiante->setTipoDeDocumento($tipoDocumento);
$nuevoEstudiante->setNumeroDocumento($documento);
$nuevoEstudiante->setNombre($nombre);
$nuevoEstudiante->setCorreo($correo);
$nuevoEstudiante->setTelefono($telefono);
$nuevoEstudiante->setSemestreActual($semestre);
$nuevoEstudiante->setProgramaAcademico($carrera);
$nuevoEstudiante->setExperiencia($experiencia);
$nuevoEstudiante->setEstado("Activo (Sin postulación)");
$nuevoEstudiante->setRutaFoto("test");

$manejoEstudiante->crearEstudiante($nuevoEstudiante);

$us->setId($documento);
$us->setUsuario($correo);
$us->setPassword($contraseñaCifrada);
$us->setEstado("V");
$us->setRolUsuario("3");
$manejoUsuario->crearUsuario($us);


$envioCorreo = new EnvioCorreo();
$envioCorreo->prepararCorreo($correoIns, ASUNTO_REGISTRO_ESTUDIANTE, CUERPO_REGISTRO_ESTUDIANTE . $contraseña);
$envioCorreo->enviarCorreo();

header("Location: ../../index.php");