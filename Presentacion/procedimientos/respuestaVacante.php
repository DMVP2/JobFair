<?php

include_once('../../rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoVacante.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEstudiante.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEmpresa.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'Estudiante.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_NEGOCIO . 'EnvioCorreo.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . ARCHIVO_PARAMETRIZACION_CORREO);


// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoEstudiante = new ManejoEstudiante($conexion);
$manejoVacante = new manejoVacante($conexion);
$manejoEmpresa = new ManejoEmpresa($conexion);

$empresa = $manejoEmpresa->buscarEmpresa($_SESSION['usuario']);


$opcion = $_GET['a'];

if (isset($_POST['docEstudiante1'])) {
    $estudiante = $manejoEstudiante->buscarEstudiante($_POST['docEstudiante1']);
} else {
    $estudiante = $manejoEstudiante->buscarEstudiante($_POST['docEstudiante2']);
}

if (isset($_POST['idVacante1'])) {
    $vacante = $manejoVacante->buscarVacante($_POST['idVacante1']);
} else {
    $vacante = $manejoVacante->buscarVacante($_POST['idVacante2']);
}

$correo = $estudiante->getCorreo() . "@unbosque.edu.co";

$asunto = "";
$cuerpo = "";

if ($opcion == 1) {
    $idVacante = $_POST['idVacante1'];
    $idEstudiante = $_POST['docEstudiante1'];
    $manejoVacante->aprobarEstudiante($idVacante, $idEstudiante);

    $asunto = ASUNTO_SELECCION_VACANTE;
    $cuerpo = CUERPO_SELECCION_VACANTE;
} else {
    $idVacante = $_POST['idVacante2'];
    $idEstudiante = $_POST['docEstudiante2'];
    $razon = $_POST['razon'];
    $manejoVacante->rechazarEstudiante($idVacante, $idEstudiante, $razon);

    $asunto = ASUNTO_RECHAZO_VACANTE;
    $cuerpo = CUERPO_RECHAZO_VACANTE . "<br><br>Razón: " . $razon;
}

$cuerpo = $cuerpo . "<br><br>Vacante: " . $vacante->getNombre() . ".<br><br>Empresa: " . $empresa->getRazonSocial() . ".<br><br>Gracias por usar la plataforma.";

$envioCorreo = new EnvioCorreo();
$envioCorreo->prepararCorreo($correo, $asunto, $cuerpo);
$envioCorreo->enviarCorreo();


header("Location: " . CARPETA_RAIZ . RUTA_TABLAS . "tablaPostulaciones.php");