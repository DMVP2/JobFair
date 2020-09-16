<?php

include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEstudiante.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'Estudiante.php');


// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoEstudiante = new ManejoEstudiante($conexion);

$documentoEstudiante = $_SESSION['usuario'];

$tipoDocumento = $_POST['tipoDocumento'];
$nombre = $_POST['nombreEstudiante'];
$semestre = $_POST['semestreEstudiante'];
$carrera = $_POST['carrera'];
$telefono = $_POST['telefonoEstudiante'];
$experiencia = $_POST['experienciaEstudiante'];
$nacimiento = $_POST['nacimientoEstudiante'];


$nuevoEstudiante = new Estudiante();

$nuevoEstudiante->setNumeroDocumento($documentoEstudiante);
$nuevoEstudiante->setTipoDeDocumento($tipoDocumento);
$nuevoEstudiante->setNombre($nombre);
$nuevoEstudiante->setTelefono($telefono);
$nuevoEstudiante->setSemestreActual($semestre);
$nuevoEstudiante->setProgramaAcademico($carrera);
$nuevoEstudiante->setExperiencia($experiencia);
$nuevoEstudiante->setFechaNacimiento($nacimiento);

$manejoEstudiante->actualizarEstudiante($nuevoEstudiante);


header("Location: " . CARPETA_RAIZ . RUTA_PORTALES . 'portalEstudiante.php');