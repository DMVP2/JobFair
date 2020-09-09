<?php

// Importación de clases

include_once('../rutas.php');
include_once('../Persistencia/Conexion.php');
include_once('../Negocio/ManejoUsuario.php');

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

        header("Location: ../Presentacion/portalAdministrador.php");

        exit();
    } else if (strnatcasecmp($rol, "Empresa") == 0) {
        session_start();

        $idUsuario = $usuarioActual->getID();

        $_SESSION['usuario'] = "$idUsuario";
        $_SESSION['rol'] = "Empresa";

        header("Location: ../Presentacion/portalEmpresa.php");

        exit();
    } else if (strnatcasecmp($rol, "Estudiante") == 0) {
        session_start();

        $idUsuario = $usuarioActual->getID();

        $_SESSION['usuario'] = "$idUsuario";
        $_SESSION['rol'] = "Estudiante";

        if (strnatcasecmp($usuarioActual->getEstado(), "V") == 0) {
            header("Location: ../Presentacion/cambioContraseña.php");
        } else {
            header("Location: ../Presentacion/portalEstudiante.php");
        }

        exit();
    }
} else {
    $mensajeaccesoincorrecto = "El usuario y la contraseña son incorrectos, por favor vuelva a introducirlos.";
    echo $mensajeaccesoincorrecto;
}