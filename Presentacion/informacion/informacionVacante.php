<?php

// Importación de clases

include_once('../../rutas.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'manejoEmpresa.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'manejoVacante.php');


header('Cache-Control: no cache'); //no cache

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

// Ejecución de métodos (Manejos)

$manejoEmpresas = new ManejoEmpresa($conexion);
$cantidadEmpresas = $manejoEmpresas->cantidadEmpresas();

$idUsuario = $_SESSION['usuario'];
$rolUsuario = $_SESSION['rol'];

if (isset($_POST['idVacante'])) {
    $idVacante = $_POST['idVacante'];
    $_SESSION['idVacante'] = $idVacante;
} else {
    $idVacante = $_SESSION['idVacante'];
}


$manejoVacantes = new ManejoVacante($conexion);
$vacante = $manejoVacantes->buscarVacante($idVacante);

$nitEmpresa = $manejoVacantes->consultarNitEmpresa($idVacante);
$empresa = $manejoEmpresas->buscarEmpresa($nitEmpresa);

if (strcasecmp($rolUsuario, "Estudiante") == 0) {
    $verificacionVacante = $manejoVacantes->verificarVacanteEstudiante($idVacante, $idUsuario);
}
?>

<!doctype html>
<html lang="en">

<head>

    <title>Feria de oportunidades</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "css/material-dashboard.css"  ?>" rel="stylesheet" />
</head>

<body>
    <div class="wrapper ">
        <!-- SideBar -->
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_COMPONENTES . "sidebar.php";
        ?>
        <!-- SideBar -->

        <div class="main-panel">
            <!-- NavBar  -->
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_COMPONENTES . "navbar.php";
            ?>
            <!-- NavBar -->

            <div class="content">
                <div class="container-fluid">
                    <!-- CONTENIDO PAGINA -->

                    <div class="row">


                    </div>

                    <div class="col-md-10" style=" margin-left: auto; margin-right: auto;">
                        <div class="card card-profile">
                            <div class="card-avatar">
                                <img class="img"
                                    src=<?php echo CARPETA_RAIZ . RUTA_IMAGENES . "Empresa/" . $empresa->getLogoEmpresa() ?>>
                            </div>
                            <div class="card-body">
                                <h5 class="card-category text-gray"> <?php echo $empresa->getRazonSocial() ?> </h5>
                                <h3 class="card-title"><?php echo $vacante->getNombre() ?></h3>
                                <br>
                                <h5 style="text-align: justify"> <strong> Descripción de la empresa: </strong>
                                    <?php echo $empresa->getDescripcion() ?> </h5>
                                <h5 style="text-align: justify"> <strong> Descripción de la vacante: </strong>
                                    <?php echo $vacante->getDescripcion() ?> </h5>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="alert alert-success" style="text-align: left"><strong> Programa
                                                académico: </strong> <?php echo $vacante->getProgramaAcademico() ?>
                                        </div>
                                        <div class="alert alert-success" style="text-align: left"><strong> Horario de la
                                                vacante: </strong> <?php echo $vacante->getHorarioVacante() ?> </div>
                                        <div class="alert alert-success" style="text-align: left"><strong> Salario de la
                                                vacante: </strong> <?php echo $vacante->getSalarioVacante() ?> </div>
                                        <div class="alert alert-success" style="text-align: left"><strong> Ubicación
                                                donde se realiza la vacante: </strong>
                                            <?php echo $vacante->getCiudad() ?> </div>
                                    </div>
                                    <div class="col-md-6">

                                        <?php
                                        if (strcasecmp($vacante->getExperiencia(), "Si") == 0) {
                                        ?>
                                        <div class="alert alert-warning" style="text-align: left"><strong> Experiencia
                                                de la vacante: </strong> <?php echo $vacante->getExperiencia() ?> </div>
                                        <?php
                                        } else {
                                        ?>
                                        <div class="alert alert-danger" style="text-align: left"><strong> Experiencia de
                                                la vacante: </strong> <?php echo $vacante->getExperiencia() ?> </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if (strcasecmp($vacante->getPosibilidadViaje(), "Si") == 0) {
                                        ?>
                                        <div class="alert alert-warning" style="text-align: left"><strong>
                                                Disponibilidad de viaje: </strong>
                                            <?php echo $vacante->getPosibilidadViaje() ?> </div>
                                        <?php
                                        } else {
                                        ?>
                                        <div class="alert alert-danger" style="text-align: left"><strong> Disponibilidad
                                                de viaje: </strong> <?php echo $vacante->getPosibilidadViaje() ?> </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <br><br>

                                <?php
                                if (strcasecmp($rolUsuario, "Estudiante") == 0) {
                                    if (strcasecmp($verificacionVacante, null) == 0) {
                                ?>
                                <input class="btn btn-primary" type="button" value="Aplicar a la vacante"
                                    onclick="window.location='<?php echo CARPETA_RAIZ . RUTA_PROCEDIMIENTOS . 'aplicarVacante.php?vacante=' . $idVacante  ?>'">

                                <br>
                                <?php
                                    } else {
                                    ?>
                                <div class="alert alert-warning" style="text-align: center"> Ya aplicaste a esta vacante
                                </div>
                                <?php
                                    }
                                }
                                if (strcasecmp($rolUsuario, "Empresa") == 0) {
                                    ?>
                                <form action="<?php echo CARPETA_RAIZ . RUTA_TABLAS . 'tablaPostulaciones.php'  ?>"
                                    method="post">
                                    <input class="btn btn-primary" type="hidden"
                                        id=<?php echo "'" . $vacante->getId() . "'"; ?> name="idVacante"
                                        value=<?php echo "'" . $vacante->getId() . "'"; ?>>
                                    <button type="submit" class="btn btn-primary"> Aspirantes a esta vacante </button>
                                </form>
                                <br>
                                <form action="<?php echo CARPETA_RAIZ . RUTA_EDITAR . 'editarVacante.php'  ?>"
                                    method="post">
                                    <input class="btn btn-primary" type="hidden" id="idVacante" name="idVacante"
                                        value=<?php echo "'" . $vacante->getId() . "'"; ?>>
                                    <button type="submit" class="btn btn-primary">Editar vacante</button>
                                </form>
                                <?php
                                }
                                ?>
                                <br>

                                <a href="<?php echo CARPETA_RAIZ . RUTA_INFORMACION . 'misVacantes.php'  ?>">Volver</a>


                                <br>
                            </div>
                        </div>
                    </div>

                    <!-- CONTENIDO PAGINA -->


                </div>
            </div>

            <!-- Footer -->
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_COMPONENTES . "footer.php";
            ?>
            <!-- Footer -->

        </div>
    </div>


    <!--   Core JS Files   -->
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/core/jquery.min.js"  ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/core/popper.min.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/core/bootstrap-material-design.min.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/perfect-scrollbar.jquery.min.js" ?>">
    </script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/moment.min.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/sweetalert2.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/jquery.validate.min.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/jquery.bootstrap-wizard.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/bootstrap-selectpicker.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/bootstrap-datetimepicker.min.js" ?>">
    </script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/jquery.dataTables.min.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/bootstrap-tagsinput.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/jasny-bootstrap.min.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/fullcalendar.min.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/jquery-jvectormap.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/nouislider.min.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/arrive.min.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/chartist.min.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/plugins/bootstrap-notify.js" ?>"></script>
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/material-dashboard.js?v=2.1.2" ?> type=" text/javascript">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script>
    $(document).ready(function() {
        $().ready(function() {
            $sidebar = $(".sidebar");

            $sidebar_img_container = $sidebar.find(".sidebar-background");

            $full_page = $(".full-page");

            $sidebar_responsive = $("body > .navbar-collapse");

            window_width = $(window).width();

            fixed_plugin_open = $(
                ".sidebar .sidebar-wrapper .nav li.active a p"
            ).html();

            if (window_width > 767 && fixed_plugin_open == "Dashboard") {
                if ($(".fixed-plugin .dropdown").hasClass("show-dropdown")) {
                    $(".fixed-plugin .dropdown").addClass("open");
                }
            }

            $(".fixed-plugin a").click(function(event) {
                if ($(this).hasClass("switch-trigger")) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $(".fixed-plugin .active-color span").click(function() {
                $full_page_background = $(".full-page-background");

                $(this).siblings().removeClass("active");
                $(this).addClass("active");

                var new_color = $(this).data("color");

                if ($sidebar.length != 0) {
                    $sidebar.attr("data-color", new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr("filter-color", new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr("data-color", new_color);
                }
            });

            $(".fixed-plugin .background-color .badge").click(function() {
                $(this).siblings().removeClass("active");
                $(this).addClass("active");

                var new_color = $(this).data("background-color");

                if ($sidebar.length != 0) {
                    $sidebar.attr("data-background-color", new_color);
                }
            });

            $(".fixed-plugin .img-holder").click(function() {
                $full_page_background = $(".full-page-background");

                $(this).parent("li").siblings().removeClass("active");
                $(this).parent("li").addClass("active");

                var new_image = $(this).find("img").attr("src");

                if (
                    $sidebar_img_container.length != 0 &&
                    $(".switch-sidebar-image input:checked").length != 0
                ) {
                    $sidebar_img_container.fadeOut("fast", function() {
                        $sidebar_img_container.css(
                            "background-image",
                            'url("' + new_image + '")'
                        );
                        $sidebar_img_container.fadeIn("fast");
                    });
                }

                if (
                    $full_page_background.length != 0 &&
                    $(".switch-sidebar-image input:checked").length != 0
                ) {
                    var new_image_full_page = $(".fixed-plugin li.active .img-holder")
                        .find("img")
                        .data("src");

                    $full_page_background.fadeOut("fast", function() {
                        $full_page_background.css(
                            "background-image",
                            'url("' + new_image_full_page + '")'
                        );
                        $full_page_background.fadeIn("fast");
                    });
                }

                if ($(".switch-sidebar-image input:checked").length == 0) {
                    var new_image = $(".fixed-plugin li.active .img-holder")
                        .find("img")
                        .attr("src");
                    var new_image_full_page = $(".fixed-plugin li.active .img-holder")
                        .find("img")
                        .data("src");

                    $sidebar_img_container.css(
                        "background-image",
                        'url("' + new_image + '")'
                    );
                    $full_page_background.css(
                        "background-image",
                        'url("' + new_image_full_page + '")'
                    );
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css(
                        "background-image",
                        'url("' + new_image + '")'
                    );
                }
            });

            $(".switch-sidebar-image input").change(function() {
                $full_page_background = $(".full-page-background");

                $input = $(this);

                if ($input.is(":checked")) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn("fast");
                        $sidebar.attr("data-image", "#");
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn("fast");
                        $full_page.attr("data-image", "#");
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr("data-image");
                        $sidebar_img_container.fadeOut("fast");
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr("data-image", "#");
                        $full_page_background.fadeOut("fast");
                    }

                    background_image = false;
                }
            });

            $(".switch-sidebar-mini input").change(function() {
                $body = $("body");

                $input = $(this);

                if (md.misc.sidebar_mini_active == true) {
                    $("body").removeClass("sidebar-mini");
                    md.misc.sidebar_mini_active = false;

                    $(".sidebar .sidebar-wrapper, .main-panel").perfectScrollbar();
                } else {
                    $(".sidebar .sidebar-wrapper, .main-panel").perfectScrollbar(
                        "destroy"
                    );

                    setTimeout(function() {
                        $("body").addClass("sidebar-mini");

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                }

                // We simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function() {
                    window.dispatchEvent(new Event("resize"));
                }, 180);

                // We stop the simulation of Window Resize after the animations are completed
                setTimeout(function() {
                    clearInterval(simulateWindowResize);
                }, 1000);
            });
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();
    });
    </script>
</body>

</html>