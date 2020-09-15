<?php


include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'Vacante.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoVacante.php');


// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoVacante = new manejoVacante($conexion);

print_r($_POST);

$titulo = $_POST['titulo'];
$programa = $_POST['programa'];
$descripcion = $_POST['descripcion'];
$horario = $_POST['horario'];
$ciudad = $_POST['dataCiudad'];
$disponibilidadViaje = $_POST['disponibilidadViaje'];
$experiencia = $_POST['experiencia'];

$salarioMin = $_POST['salarioMin'];
$salarioMax = $_POST['salarioMax'];
$salario = $salarioMin . " - " . $salarioMax;

$vacante = new Vacante();
$vacante->setNombre($titulo);
$vacante->setDescripcion($descripcion);
$vacante->setProgramaAcademico($programa);
$vacante->setHorarioVacante($horario);
$vacante->setPosibilidadViaje($disponibilidadViaje);
$vacante->setSalarioVacante($salario);
$vacante->setExperiencia($experiencia);
$vacante->setEstado("Activo");

$manejoVacante->crearVacante($vacante);


$arregloCategorias = $_POST['dataCategoria'];

$idVacante = $manejoVacante->obtenerIdUltimaVacante();

$aux = 0;
foreach ($arregloCategorias as $categoria) {

    $manejoVacante->relacionarCategoriaVacante($categoria, $idVacante);
    $aux = $aux + 1;
}

$ciudad = $_POST['dataCiudad'];
$manejoVacante->relacionarCategoriaVacante($ciudad, $idVacante);

$manejoVacante->relacionarCiudadVacante($idVacante, $ciudad);

$manejoVacante->relacionarEmpresaVacante($idVacante, $_SESSION['usuario']);

header("Location: " . CARPETA_RAIZ . RUTA_INFORMACION . "misVacantes.php");