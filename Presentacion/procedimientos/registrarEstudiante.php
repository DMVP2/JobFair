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


// RECIBIR IMAGEN

$imgFile = $_FILES['user_image']['name'];
$tmp_dir = $_FILES['user_image']['tmp_name'];
$imgSize = $_FILES['user_image']['size'];


if (empty($imgFile)) {
    $userpic = "default.png";
} else {
    $upload_dir = '../img/Estudiante/'; //Cargar directorio a la ruta especificada

    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); //Información sobre la extensión del archivo


    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');  //Extensiónes validas

    //Renonbrar archivo
    $userpic = $documento . "." . $imgExt;
    //Permitir imagenes de formatos validos
    if (in_array($imgExt, $valid_extensions)) {
        //Verificar tamaño del archivo '1 MB'
        if ($imgSize < 1000000) {
            move_uploaded_file($tmp_dir, $upload_dir . $userpic);
        } else {
            echo 'No se pudo';
        }
    } else {
        echo 'Se pudo';
    }
}

// RECIBIR IMAGEN


$nuevoEstudiante = new Estudiante();
$us = new Usuario();

print_r($_POST);

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
$nuevoEstudiante->setRutaFoto($userpic);
$nuevoEstudiante->setFechaNacimiento($nacimiento);

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