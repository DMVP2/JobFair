<?php

// Importación de clases

include_once('../rutas.php');

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

// Ejecución de métodos (Manejos)

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoVacante.php');


$manejoVacante = new ManejoVacante($conexion);



?>
<!DOCTYPE html>
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

    <!-- JQuerry -->
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>

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

                            <div class="col-md-7" style=" margin-left: auto; margin-right: auto;">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <p class="card-category">Vacante
                                        </p>
                                        <h4 class="card-title">¡Consigue nuevos practicantes!
                                        </h4>


                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-9" style=" margin-left: auto; margin-right: auto;">


                                                <form id="formularioVacante" method="POST"
                                                    action="<?php echo CARPETA_RAIZ . RUTA_PROCEDIMIENTOS . 'crearVacante.php' ?>">
                                                    <br><br>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Titulo</label>
                                                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Programa:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select class="form-group form-control"
                                                                style="margin-top: 4px;" id="programa" name="programa"
                                                                required>
                                                                <option value="Ingeniería de Sistemas">Ingeniería de
                                                                    Sistemas</option>
                                                                <option value="Ingeniería Electrónica">Ingeniería
                                                                    Electrónica</option>
                                                                <option value="Ingeniería Ambiental">Ingeniería
                                                                    Ambiental</option>
                                                                <option value="Ingeniería Industrial">Ingeniería
                                                                    Industrial</option>
                                                                <option value="Bioingeniería">Bioingeniería</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <br><br>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label class="bmd-label-floating">
                                                                        Descripción:</label>
                                                                    <textarea class="form-control" maxlength="950"
                                                                        name="descripcion" id="descripcion"
                                                                        rows="6"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="alert alert-info" style="height: 50px;">
                                                        <h6> Categorías</h6>
                                                    </div>

                                                    <div id="divCategoria">

                                                    </div>

                                                    <br><br>

                                                    <div class="text-center">
                                                        <input class="btn btn-warning" type="button"
                                                            value="Agregar campo" onclick="agregarCampoCategoria()">
                                                        <input class="btn btn-warning" type="button"
                                                            value="Borrar campo" onclick="eliminarCampoCategoria()">
                                                    </div>

                                                    <br><br><br>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Jornada:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="form-group form-control"
                                                                style="margin-top: 4px;" id="horario" name="horario"
                                                                required>
                                                                <option value="Diurna">Diurna
                                                                </option>
                                                                <option value="Nocturna">Nocturna</option>
                                                                <option value="A definir">A definir
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <br><br>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="bmd-label-floating"
                                                                style="padding-top: 15px;">
                                                                Salario mínimo:
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control"
                                                                    id="salarioMin" name="salarioMin" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="bmd-label-floating"
                                                                style="padding-top: 15px;">
                                                                Salario máximo:
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control"
                                                                    id="salarioMax" name="salarioMax" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="bmd-label-floating"
                                                                style="padding-top: 15px;">
                                                                Ciudad:
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <select class="form-control" id="dataCiudad"
                                                                    name="dataCiudad" required>
                                                                    <?php

                                                                    $listaCiudades = $manejoVacante->listarCiudades();

                                                                    foreach ($listaCiudades as $ciudad) {
                                                                        if ($ciudad[1] == "Bogotá") {
                                                                            echo "<option value=" . $ciudad[0] . " selected>" . $ciudad[1] . "</option>";
                                                                        } else {
                                                                            echo "<option value=" . $ciudad[0] . ">" . $ciudad[1] . "</option>";
                                                                        }
                                                                    }

                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="bmd-label-floating"
                                                                style="padding-top: 15px;">
                                                                Disponibilidad de viaje:
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">

                                                            <select class="form-control" id="disponibilidadViaje"
                                                                name="disponibilidadViaje" required>
                                                                <option value="Si">Si</option>
                                                                <option value="No" selected>No</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Experiencia:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="form-group form-control"
                                                                style="margin-top: 4px;" id="experiencia"
                                                                name="experiencia" required>
                                                                <option value="Si">Si
                                                                </option>
                                                                <option value="No" selected>No</option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <br><br><br>

                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <input type="submit" class="btn btn-primary pull-center"
                                                                value="Crear vacante">

                                                            <br><br>

                                                            <a
                                                                href="<?php echo CARPETA_RAIZ . RUTA_INFORMACION . 'misVacantes.php'  ?>">Volver</a>
                                                        </div>

                                                    </div>
                                                    <br><br>
                                                    <div class="clearfix"></div>
                                                </form>
                                            </div>
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
    <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/material-dashboard.js?v=2.1.2" ?> type=" text/javascript">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script>
    function agregarCampoCategoria() {

        $("<div>").load(
            "<?php echo CARPETA_RAIZ . RUTA_CAMPOS . 'vacante/listaCategoria.php' ?>",
            function() {
                $("#divCategoria").append($(this).html());
            });
    }

    function eliminarCampoCategoria() {

        if ($('#divCategoria div.divListId').length > 1) {
            $('#divCategoria div.divListId:last').remove();
        } else {
            $('#divCategoria div.divListId:last').remove();
            agregarCampoCategoria();
        }
    }
    </script>

    <script>
    $(document).ready(function() {



        $("<div>").load(
            "<?php echo CARPETA_RAIZ . RUTA_CAMPOS . 'vacante/listaCategoria.php' ?>",
            function() {
                $("#divCategoria").append($(this).html());
            });

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
    <script>
    $(document).ready(function() {
        $('#records-limit').change(function() {
            $('form').submit();
        })
    });
    </script>


</body>

</html>