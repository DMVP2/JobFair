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

    echo $nickname;
    echo $passwordCifrado;

    if(strnatcasecmp($nickname, $usuario) == 0 AND strnatcasecmp($passwordCifrado, md5($password)) == 0)
    {

        $rol = $usuarioActual->getRolUsuario();


        if(strnatcasecmp($rol,"Administrador") == 0)
        {
            session_start();
 
            $_SESSION['administrador'] = "$usuario";
    
            header("Location: ../Presentacion/tablaEstudiante.php");
    
            exit();
        }
        if(strnatcasecmp($rol,"Empresa") == 0)
        {
            session_start();
 
            $_SESSION['Empresa'] = "$usuario";
    
            header("Location: ../Presentacion/template.php");
    
            exit();
        }
        if(strnatcasecmp($rol,"Estudiante") == 0)
        {
            session_start();
 
            $_SESSION['Estudiante'] = "$usuario";
    
            header("Location: ../Presentacion/tablaEstudiante.php");
    
            exit();
        }
    }
    else 
    {
        $mensajeaccesoincorrecto = "El usuario y la contraseña son incorrectos, por favor vuelva a introducirlos.";
        echo $mensajeaccesoincorrecto; 
    }

    ?>