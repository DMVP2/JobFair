<?php

include_once('../../Rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . ARCHIVO_PARAMETRIZACION_CORREO);

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoUSuario.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . 'Usuario.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_NEGOCIO . 'EnvioCorreo.php');


// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$manejoUsuario = new ManejoUsuario($conexion);

$usuario = $_POST['usuarioEstudiante'];
$correo = $usuario . "@unbosque.edu.co";

$us = new Usuario();
$contraseña = $us->crearPassword();
$contraseñaCifrada = md5($contraseña);

$us->setUsuario($usuario);
$us->setPassword($contraseñaCifrada);

$manejoUsuario->modificarUsuarioContraseña($us);


$envioCorreo = new EnvioCorreo();
$envioCorreo->prepararCorreo($correo, ASUNTO_RECUPERAR_CLAVE, CUERPO_RECUPERAR_CLAVE . $contraseña);
$envioCorreo->enviarCorreo();