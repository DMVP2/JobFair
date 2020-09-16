<?php

include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'Vacante.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoVacante.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoVacante = new ManejoVacante($conexion);

$idVacante = $_POST['idVacante'];
$titulo = $_POST['titulo'];
$programa = $_POST['carrera'];
$descripcion = $_POST['descripcion'];
$horario = $_POST['horario'];
$ciudad = $_POST['dataCiudad'];
$disponibilidadViaje = $_POST['disponibilidadViaje'];
$experiencia = $_POST['experiencia'];

$salarioMin = $_POST['salarioMin'];
$salarioMax = $_POST['salarioMax'];
$salario = $salarioMin . " - " . $salarioMax;

$vacante = new Vacante();
$vacante->setId($idVacante);
$vacante->setNombre($titulo);
$vacante->setDescripcion($descripcion);
$vacante->setProgramaAcademico($programa);
$vacante->setHorarioVacante($horario);
$vacante->setPosibilidadViaje($disponibilidadViaje);
$vacante->setSalarioVacante($salario);
$vacante->setExperiencia($experiencia);
$vacante->setEstado("Activo");

$manejoVacante->actualizarVacante($vacante);


$manejoVacante->limpiarCategoriasVacante($idVacante);

$arregloCategorias = $_POST['dataCategoria'];

$aux = 0;
foreach ($arregloCategorias as $categoria) {

    $manejoVacante->relacionarCategoriaVacante($categoria, $idVacante);
    $aux = $aux + 1;
}

$ciudad = $_POST['dataCiudad'];

$manejoVacante->editarCiudadVacante($idVacante, $ciudad);

header("Location: " . CARPETA_RAIZ . RUTA_INFORMACION . "informacionVacante.php");