<?php

include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoHojaDeVida.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'HojaDeVida.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'Estudios.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'ExperienciaLaboral.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'ExperienciaAcademica.php');



// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$idUsuario = $_SESSION['usuario'];

$manejoHojaVida = new ManejoHojaDeVida($conexion);

if ($manejoHojaVida->buscarHojaVida($idUsuario) != null) {
    $manejoHojaVida->limpiarDatosHojaVida($idUsuario);
}



// OBTENER DATOS PARA TABLA HOJA VIDA
$perfilProfesional = $_POST['perfilProfesionalArea'];
$certificaciones = $_POST['certificacionesArea'];
$disponibilidadViaje = $_POST['disponibilidadViaje'];


$hojaVidaAgregar = new HojaDeVida();
$hojaVidaAgregar->setPerfilProfesional($perfilProfesional);
$hojaVidaAgregar->setDisponibilidadViaje($disponibilidadViaje);
$hojaVidaAgregar->setCertificaciones($certificaciones);
$hojaVidaAgregar->setDocumento($idUsuario);


$manejoHojaVida->crearHojaVida($hojaVidaAgregar);

//OBTENER DATOS PARA LA TABLA ESTUDIOS

$idHojaVida = $manejoHojaVida->consultarIdHojaVida($idUsuario);

$arregloEstudios = $_POST['nivelEstudio'];
$arregloInstituciones = $_POST['institucion'];
$arregloAñoInicioEducacion = $_POST['estudiosIngreso'];
$arregloAñoFinalEducacion = $_POST['estudiosSalida'];

if (isset($_POST['nombreEstudio'])) {
    $arregloNombreEstudio = $_POST['nombreEstudio'];
    $arregloAreaEstudio = $_POST['areaEstudio'];
}

$aux = 0;
$auxNoBachiller = 0;

foreach ($arregloEstudios as $nivelEstudio) {

    $estudio = new Estudios();
    $estudio->setNivelEstudio($nivelEstudio);

    $estudio->setInstitucion($arregloInstituciones[$aux]);

    $fechaEstudios = $arregloAñoInicioEducacion[$aux] . " - " . $arregloAñoFinalEducacion[$aux];
    $estudio->setFecha($fechaEstudios);

    if (strcmp($nivelEstudio, "Bachiller") !== 0) {

        $estudio->setNombre($arregloNombreEstudio[$auxNoBachiller]);
        $estudio->setArea($arregloAreaEstudio[$auxNoBachiller]);

        $auxNoBachiller = $auxNoBachiller + 1;
    } else {

        $estudio->setNombre("No aplica");
        $estudio->setArea("No aplica");
    }

    $manejoHojaVida->crearEstudio($estudio, $idHojaVida);

    $aux = $aux + 1;
}

if (isset($_POST["expAcademica"])) {

    $arregloExpA = $_POST['expAcademica'];
    $arregloDescripcionesExpA = $_POST['descripcionExp'];
    $arregloInstitucionExpA = $_POST['institucionExpA'];
    $arregloAñosExpA = $_POST['añoExpAcademica'];

    $aux = 0;
    foreach ($arregloExpA as $actual) {

        $expA = new ExperienciaAcademica();
        $expA->setNombre($actual);
        $expA->setDescripcion($arregloDescripcionesExpA[$aux]);
        $expA->setInstitucion($arregloInstitucionExpA[$aux]);
        $expA->setFecha($arregloAñosExpA[$aux]);

        $manejoHojaVida->crearExperienciaAcademica($expA, $idHojaVida);

        $aux = $aux + 1;
    }
}


if (isset($_POST["cargoExperiencia"])) {

    $arregloCargos = $_POST['cargoExperiencia'];
    $arregloEmpresas = $_POST['empresaExperiencia'];
    $arregloDescripcionExp = $_POST['descripcionExperiencia'];
    $arregloAñosIngresoExp = $_POST['añoInicio'];
    $arregloAñosSalidaExp = $_POST['añoSalida'];

    $aux = 0;
    foreach ($arregloCargos as $cargo) {

        $experiencia = new ExperienciaLaboral();
        $experiencia->setCargo($arregloCargos[$aux]);
        $experiencia->setDescripcion($arregloEmpresas[$aux]);
        $experiencia->setEmpresa($arregloEmpresas[$aux]);

        $fechaExp = $arregloAñosIngresoExp . " - " . $arregloAñosSalidaExp;
        $experiencia->setFecha($fechaExp);


        $manejoHojaVida->crearExperiencia($experiencia, $idHojaVida);

        $aux = $aux + 1;
    }
}

$arregloIdiomas = $_POST['idiomas'];
$arregloNiveles = $_POST['niveles'];

$aux = 0;
foreach ($arregloIdiomas as $idioma) {

    $manejoHojaVida->crearHojaVidaIdioma($idHojaVida, $idioma, $arregloNiveles[$aux]);

    $aux = $aux + 1;
}

$arregloNombreRef = $_POST['nombreReferencia'];
$arregloTelefonoRef = $_POST['telefonoReferencia'];
$arregloParentescoRef = $_POST['parentescoReferencia'];

$aux = 0;
foreach ($arregloNombreRef as $nombreRef) {

    $datosReferencia[0] = $arregloNombreRef[$aux];
    $datosReferencia[1] = $arregloTelefonoRef[$aux];
    $datosReferencia[2] = $arregloParentescoRef[$aux];


    $manejoHojaVida->crearHojaVidaReferencia($datosReferencia, $idHojaVida);

    $aux = $aux + 1;
}

header("Location: " . CARPETA_RAIZ . RUTA_PORTALES . "PortalEstudiante.php");