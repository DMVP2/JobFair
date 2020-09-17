<?php

// Importación de clases

$idUsuario = $_SESSION['usuario'];
$rolUsuario = $_SESSION['rol'];
?>

<div class="sidebar" data-color="purple" data-background-color="white">

    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            Modulo de <?php echo $rolUsuario ?>
        </a>
    </div>
    <div class="sidebar-wrapper">

        <!-- En caso de que el usuario se "Administrador" -->

        <?php if (strcasecmp($rolUsuario, "Administrador") == 0) {
        ?>

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CARPETA_RAIZ . RUTA_PORTALES . 'portalAdministrador.php' ?>">
                    <i class="material-icons">home</i>
                    <p>Inicio</p>
                </a>
            </li>
            <br>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="material-icons">assessment</i>
                    <p>Gestión de información</p>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownProfile">
                    <a class="dropdown-item" href="<?php echo CARPETA_RAIZ . RUTA_TABLAS . 'tablaEmpresa.php' ?>">
                        <i class="material-icons">apartment</i>
                        <p>Empresas</p>
                    </a>
                    <a class="dropdown-item" href="<?php echo CARPETA_RAIZ . RUTA_TABLAS . 'tablaEstudiante.php' ?>">
                        <i class="material-icons">face</i>
                        <p>Estudiantes</p>
                    </a>
                    <a class="dropdown-item" href="<?php echo CARPETA_RAIZ . RUTA_TABLAS . 'tablaVacante.php' ?>">
                        <i class="material-icons">assessment</i>
                        <p>Vacantes</p>
                    </a>
                    <a class="dropdown-item" href="<?php echo CARPETA_RAIZ . RUTA_TABLAS . 'tablaUsuario.php' ?>">
                        <i class="material-icons">person</i>
                        <p>Usuarios del sistema</p>
                    </a>
                </div>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="material-icons">groups</i>
                    <p>Reportes</p>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownProfile">
                    <a class="dropdown-item"
                        href="<?php echo CARPETA_RAIZ . RUTA_REPORTES . 'reporteEstudiantes.php' ?>">
                        <p>Estudiantes por Programa</p>
                    </a>
                    <a class="dropdown-item"
                        href="<?php echo CARPETA_RAIZ . RUTA_REPORTES . 'reporteCantidadAplicacionesEmpresa.php' ?>">
                        <p>Aplicaciones por Empresa</p>
                    </a>
                    <a class="dropdown-item"
                        href="<?php echo CARPETA_RAIZ . RUTA_REPORTES . 'reporteEstadoAplicacionEstudiantes.php' ?>">
                        <p>Aplicación de Estudiantes</p>
                    </a>
                    <a class="dropdown-item"
                        href="<?php echo CARPETA_RAIZ . RUTA_REPORTES . 'reporteMasMenosAplicaciones.php' ?>">

                        <p>Mas - menos aplicaciones</p>
                    </a>
                </div>
            </li>
            <br>
        </ul>

        <?php
        }
        ?>

        <!-- En caso de que el usuario se "Empresa" -->

        <?php if (strcasecmp($rolUsuario, "Empresa") == 0) {
        ?>

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CARPETA_RAIZ . RUTA_PORTALES . 'portalEmpresa.php' ?>">
                    <i class="material-icons">home</i>
                    <p>Inicio</p>
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CARPETA_RAIZ . RUTA_INFORMACION . 'misVacantes.php' ?>">
                    <i class="material-icons">assessment</i>
                    <p>Mis vacantes</p>
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CARPETA_RAIZ . RUTA_TABLAS . 'tablaPostulados.php' ?>">
                    <i class="material-icons">work</i>
                    <p>Postulados</p>
                </a>
            </li>
        </ul>

        <?php
        }
        ?>

        <!-- En caso de que el usuario se "Estudiante" -->

        <?php if (strcasecmp($rolUsuario, "Estudiante") == 0) {
        ?>

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CARPETA_RAIZ . RUTA_PORTALES . 'portalEstudiante.php' ?>">
                    <i class="material-icons">home</i>
                    <p>Inicio</p>
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CARPETA_RAIZ . RUTA_INFORMACION . 'listadoVacantes.php' ?>">
                    <i class="material-icons">assessment</i>
                    <p>Buscador de vacantes</p>
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CARPETA_RAIZ . RUTA_INFORMACION . 'listadoEmpresas.php' ?>">
                    <i class="material-icons">work</i>
                    <p>Buscador de empresas</p>
                </a>
            </li>
            <br>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo CARPETA_RAIZ . RUTA_INFORMACION . 'misVacantes.php' ?>">
                    <i class="material-icons">done_outline</i>
                    <p>Mis postulaciones</p>
                </a>
            </li>
        </ul>

        <?php
        }
        ?>
    </div>
</div>