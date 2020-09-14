<?php

function catch_fatal_error()
{
    $error =  error_get_last();

    if ($error['type'] == E_ERROR) {
        header("Location: ../Presentacion/login.php?error=1");
    }
}
register_shutdown_function('catch_fatal_error');

// Importación de clases

include_once('../rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoUsuario.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

$usuario = $_POST["usuario"];
$password = $_POST["password"];

// Ejecución de métodos (Manejos)

$manejoUsario = new ManejoUsuario($conexion);

// Verificación de roles

$usuarioActual = $manejoUsario->buscarUsuarioPorNickname($usuario);

$nickname = $usuarioActual->getUsuario();
$passwordCifrado = $usuarioActual->getPassword();



if (strnatcasecmp($nickname, $usuario) == 0 and strnatcasecmp($passwordCifrado, md5($password)) == 0) {

    $rol = $usuarioActual->getRolUsuario();

    if (strnatcasecmp($rol, "Administrador") == 0) {
        session_start();

        $idUsuario = $usuarioActual->getID();

        $_SESSION['usuario'] = "$idUsuario";
        $_SESSION['rol'] = "Administrador";

        header("Location: " . CARPETA_RAIZ . RUTA_PORTALES . "portalAdministrador.php");

        exit();
    } else if (strnatcasecmp($rol, "Empresa") == 0) {

        if (strnatcasecmp($usuarioActual->getEstado(), "Activo (Sin verificar)") == 0) {
            header("Location: " . CARPETA_RAIZ . RUTA_PRESENTACION . "login.php?error=2");
        } else {
            session_start();

            $idUsuario = $usuarioActual->getID();

            $_SESSION['usuario'] = "$idUsuario";
            $_SESSION['rol'] = "Empresa";


            header("Location: " . CARPETA_RAIZ . RUTA_PORTALES . "portalEmpresa.php");
        }


        exit();
    } else if (strnatcasecmp($rol, "Estudiante") == 0) {
        session_start();

        $idUsuario = $usuarioActual->getID();

        $_SESSION['usuario'] = "$idUsuario";
        $_SESSION['rol'] = "Estudiante";

        if (strnatcasecmp($usuarioActual->getEstado(), "Activo (Sin verificar)") == 0) {
            header("Location: " . CARPETA_RAIZ . RUTA_PRESENTACION . "cambioContraseña.php");
        } else {
            header("Location: " . CARPETA_RAIZ . RUTA_PORTALES . "portalEstudiante.php");
        }

        exit();
    }
} else {
    header("Location: " . CARPETA_RAIZ . RUTA_PRESENTACION . "login.php?error=1");
}