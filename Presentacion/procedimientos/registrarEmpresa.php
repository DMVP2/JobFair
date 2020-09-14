<?php


print_r($_FILES);

include_once('../../rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEmpresa.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoUsuario.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'Empresa.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'Representante.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'Usuario.php');

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


// RECIBIR CAMARA COMERCIO - Star
$docFile = $_FILES['camaraComercio']['name'];
$tmp_dir = $_FILES['camaraComercio']['tmp_name'];
$docSize = $_FILES['camaraComercio']['size'];


if (empty($docFile)) {
    $document = "default.pdf";
} else {
    $upload_dir = '../documentos/'; //Cargar directorio a la ruta especificada
    $documentExt = strtolower(pathinfo($docFile, PATHINFO_EXTENSION)); //Información sobre la extensión del archivo
    $valid_extensions = array('pdf');  //Extensiónes validas

    //Renonbrar archivo
    $document = $nit . "." . $documentExt;

    if (in_array($documentExt, $valid_extensions)) {
        //Verificar tamaño del archivo '1 MB'
        if ($docSize < 1000000) {
            move_uploaded_file($tmp_dir, $upload_dir . $document);
            
        } else {
            //Si no se puede
        }
    } else {
        //Si se puede
    }
}
// RECIBIR CAMARA COMERCIO - End


// RECIBIR IMAGEN - Start
$imgFile = $_FILES['user_image']['name'];
$tmp_dir = $_FILES['user_image']['tmp_name'];
$imgSize = $_FILES['user_image']['size'];


if (empty($imgFile)) {
    $userpic = "default.png";
} else {
    $upload_dir = '../imagenes/Empresa/'; //Cargar directorio a la ruta especificada

    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); //Información sobre la extensión del archivo


    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');  //Extensiónes validas

    //Renonbrar archivo
    $userpic = $nit . "." . $imgExt;
    //Permitir imagenes de formatos validos

    if (in_array($imgExt, $valid_extensions)) {

        //Verificar tamaño del archivo '1 MB'
        if ($imgSize < 1000000) {
            move_uploaded_file($tmp_dir, $upload_dir . $userpic);
            
        } else {
            //echo 'No se pudo';
        }
    } else {
        //echo 'Se pudo';
    }
}
// RECIBIR IMAGEN - End

$empresa = new Empresa();
$empresa->setNit($nit);
$empresa->setRazonComercial($razonComercial);
$empresa->setRazonSocial($razonSocial);
$empresa->setDescripcion($descripcion);
$empresa->setOtrosBeneficios($beneficios);
$empresa->setLogoEmpresa($userpic);
$empresa->setCamaraComercio($document);
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
$us->setEstado("Activo (Sin verificar)");
$us->setRolUsuario("2");
$manejoUsuario->crearUsuario($us);

header("Location: ../../index.php");