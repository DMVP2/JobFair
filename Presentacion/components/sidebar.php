<?php

// Importación de clases

include_once('../rutas.php');

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
                    <a class="nav-link" href="portalAdministrador.php">
                        <i class="material-icons">home</i>
                        <p>Inicio</p>
                    </a>
                </li>
                <br>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="material-icons">assessment</i>
                        <p>Gestión de información</p>
                    </a>
                </li>
                <br>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="material-icons">analytics</i>
                        <p>Reportes</p>
                    </a>
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
                    <a class="nav-link" href="portalEmpresa.php">
                        <i class="material-icons">home</i>
                        <p>Inicio</p>
                    </a>
                </li>
                <br>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="material-icons">assessment</i>
                        <p>Mis vacantes</p>
                    </a>
                </li>
                <br>
                <li class="nav-item">
                    <a class="nav-link" href="#">
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
                    <a class="nav-link" href="portalEstudiante.php">
                        <i class="material-icons">home</i>
                        <p>Inicio</p>
                    </a>
                </li>
                <br>
                <li class="nav-item">
                    <a class="nav-link" href="listadoVacantes.php">
                        <i class="material-icons">assessment</i>
                        <p>Buscador de vacantes</p>
                    </a>
                </li>
                <br>
                <li class="nav-item">
                    <a class="nav-link" href="listadoEmpresas.php">
                        <i class="material-icons">work</i>
                        <p>Buscador de empresas</p>
                    </a>
                </li>
                <br>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="material-icons">done_outline</i>
                        <p>Mis vacantes</p>
                    </a>
                </li>
            </ul>

        <?php
        }
        ?>
    </div>
</div>