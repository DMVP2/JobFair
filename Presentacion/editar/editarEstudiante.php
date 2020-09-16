<?php

// Importación de clases

include_once('../../rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEstudiante.php');


// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

// Ejecución de métodos (Manejos)
$manejoEstudiantes = new ManejoEstudiante($conexion);

$documentoEstudiante = $_SESSION['usuario'];

$estudiante = $manejoEstudiantes->buscarEstudiante($documentoEstudiante);

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

                    <div>
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <p class="card-category">Actualiza tu información
                                        </p>
                                        <h4 class="card-title">Manten tu información actualizada
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form id="formRegistroEstudiante" method="POST"
                                                    action="<?php echo CARPETA_RAIZ . RUTA_PROCEDIMIENTOS . 'actualizarEstudiante.php'  ?>">
                                                    <br>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-2"></div>

                                                        <div class="col-md-7">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <select class="form-group form-control"
                                                                        style="margin-top: 4px;" id="tipoDocumento"
                                                                        name="tipoDocumento" required>
                                                                        <?php
                                                                        $tiposDocumentos = ["C.C.", "T.I.", "C.E."];

                                                                        foreach ($tiposDocumentos as $tipo) {
                                                                            echo "<option value='" . $tipo . "'";

                                                                            if (strcasecmp($tipo, $estudiante->getTipoDeDocumento()) == 0) {
                                                                                echo " selected ";
                                                                            }

                                                                            echo " >" . $tipo . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="bmd-label-floating">Documento</label>
                                                                        <input type="number" min="0"
                                                                            class="form-control"
                                                                            id="documentoEstudiante"
                                                                            name="documentoEstudiante"
                                                                            pattern="^((\d{8})|(\d{10})|(\d{11})|(\d{6}-\d{5}))?$"
                                                                            title="Solo se permiten los siguientes documentos: C.C., C.E., T.I."
                                                                            value="<?php echo $estudiante->getNumeroDocumento() ?>"
                                                                            disabled required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="bmd-label-floating">Nombre</label>
                                                                        <input type="text" class="form-control"
                                                                            pattern="[a-zA-Z0-9\s]+"
                                                                            title="El nombre solo puede contener letras"
                                                                            id="nombreEstudiante"
                                                                            name="nombreEstudiante"
                                                                            value="<?php echo $estudiante->getNombre() ?>"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="bmd-label-floating">Correo</label>
                                                                        <input type="text" class="form-control"
                                                                            pattern="^[a-zA-Z]+$"
                                                                            title="Solo debe incluir el nombre de usuario del correo institucional"
                                                                            id="correoEstudiante"
                                                                            name="correoEstudiante"
                                                                            value="<?php echo $estudiante->getCorreo() . "@unbosque.edu.co" ?>"
                                                                            disabled required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="bmd-label-floating">Semestre</label>
                                                                        <input type="number" min="6" max="10"
                                                                            id="semestreEstudiante"
                                                                            name="semestreEstudiante"
                                                                            class="form-control"
                                                                            value="<?php echo $estudiante->getSemestreActual() ?>"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <select class="form-group form-control"
                                                                        style="margin-top: 4px;" id="carrera"
                                                                        name="carrera" required>
                                                                        <?php
                                                                        $carreras = ["Ingeniería de Sistemas", "Ingeniería Electrónica", "Ingeniería Ambiental", "Ingeniería Industrial", "Bioingeniería"];

                                                                        foreach ($carreras as $carrera) {
                                                                            echo "<option value='" . $carrera . "'";

                                                                            if (strcasecmp($carrera, $estudiante->getProgramaAcademico()) == 0) {
                                                                                echo " selected ";
                                                                            }

                                                                            echo " >" . $carrera . "</option>";
                                                                        }
                                                                        ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="bmd-label-floating">Teléfono
                                                                            celular</label>
                                                                        <input type="number" min="1"
                                                                            class="form-control"
                                                                            pattern="(\+57|0057|57)?[ -]*(3)[ -]*([0-9][ -]*){10}"
                                                                            title="Solo se permite el número del teléfono celular. Opcionalmente puede incluir el código de país en diferentes formatos si asi lo desea."
                                                                            id="telefonoEstudiante"
                                                                            name="telefonoEstudiante"
                                                                            value="<?php echo $estudiante->getTelefono() ?>"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="bmd-label-floating"
                                                                        style="padding-top: 15px;">
                                                                        Experiencia laboral:
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select class="form-control"
                                                                        id="experienciaEstudiante"
                                                                        name="experienciaEstudiante" required>
                                                                        <option value="No" selected>No tengo</option>
                                                                        <option value="Si">Si tengo</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="bmd-label-floating">
                                                                            Fecha de nacimiento</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="date" class="form-control"
                                                                            min="1950-01-01" max="2006-01-01"
                                                                            id="nacimientoEstudiante"
                                                                            name="nacimientoEstudiante"
                                                                            value="<?php echo $estudiante->getFechaNacimiento() ?>"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <br><br><br>
                                                            <div class="row">
                                                                <div class="col-md-12 text-center">
                                                                    <button id="botonRegistrar" name="botonRegistrar"
                                                                        class="btn btn-primary pull-center">Actualizar</button>
                                                                    <br><br>
                                                                    <center><a
                                                                            href="<?php echo CARPETA_RAIZ . RUTA_PORTALES . 'portalEstudiante.php'  ?>">Volver</a>
                                                                    </center>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="clearfix"></div>
                                                </form>
                                            </div>
                                        </div>


                                    </div>
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
        <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/material-dashboard.js?v=2.1.2" ?> type="
            text/javascript"> </script>
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