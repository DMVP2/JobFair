<?php


// Importación de clases

include_once('../../rutas.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'ManejoEstudiante.php');


// Nombre de la pagina

$nombrePagina = basename(__FILE__);

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

// Ejecución de métodos (Manejos)

$idUsuario = $_SESSION['usuario'];

$manejoEstudiante = new ManejoEstudiante($conexion);

// Paginación

if (isset($_POST['records-limit'])) {
    $_SESSION['records-limit'] = $_POST['records-limit'];
}

$limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 10;
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$paginationStart = ($page - 1) * $limit;

// RETORNA EL ARREGLO DE LA BD

$estudiantes = $manejoEstudiante->listarPostulaciones($idUsuario, $paginationStart, $limit);

// CANTIDAD TOTAL A CARGAR - COUNT BD

$allRecords = $manejoEstudiante->cantidadEstudiantes();

// Total de las paginas

$totalPages = ceil($allRecords / $limit);

// Prev + Next

$prev = $page - 1;
$next = $page + 1;

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- CSS Files -->
    <link href="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "css/material-dashboard.css?v=2.1.2"  ?>" rel="stylesheet" />
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

                    <!-- Select dropdown -->
                    <div class="d-flex flex-row-reverse bd-highlight mb-3">
                        <form action="<?php echo $nombrePagina ?>" method="post">
                            <select name="records-limit" id="records-limit" class="custom-select">
                                <option disabled selected>Límite</option>
                                <?php foreach ([5, 10, 15, 20] as $limit) : ?>
                                <option
                                    <?php if (isset($_SESSION['records-limit']) && $_SESSION['records-limit'] == $limit) echo 'selected'; ?>
                                    value="<?= $limit; ?>">
                                    <?= $limit; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </div>
                    <!-- Select dropdown -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">Postulados</h4>
                                    <p class="card-category"> Listado de estudiantes que postulan su hoja de vida a esta
                                        empresa </p>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive">


                                        <table class="table">
                                            <thead class=" text-primary">
                                                <th>
                                                    Número de documento
                                                </th>
                                                <th>
                                                    Nombre
                                                </th>
                                                <th>
                                                    Correo
                                                </th>
                                                <th>
                                                    Programa académico
                                                </th>
                                                <th>
                                                    Semestre
                                                </th>
                                                <th>
                                                    Perfil
                                                </th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($estudiantes as $estudiante) {
                                                ?>
                                                <thead class=" text-primary">
                                                    <th>
                                                        <?php echo $estudiante->getNumeroDocumento() ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $estudiante->getNombre() ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $estudiante->getCorreo() ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $estudiante->getProgramaAcademico() ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $estudiante->getSemestreActual() ?>
                                                    </th>
                                                    <th>
                                                        <form
                                                            action=" <?php echo CARPETA_RAIZ . RUTA_INFORMACION . "informacionEstudiante.php" ?>"
                                                            method="post">
                                                            <input class="btn btn-primary" type="hidden"
                                                                id=<?php echo "'" . $estudiante->getNumeroDocumento() . "'"; ?>
                                                                name="idEstudiante"
                                                                value=<?php echo "'" . $estudiante->getNumeroDocumento() . "'"; ?>>
                                                            <button class="btn btn-success" type="submit" id="submit"
                                                                name="estudiante" value="">
                                                                <i class="material-icons">visibility</i>
                                                            </button>
                                                        </form>

                                                    </th>
                                                </thead>

                                                <?php
                                                }

                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation example mt-5">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php if ($page <= 1) {
                                                        echo 'disabled';
                                                    } ?>">
                                <a class="page-link" href="<?php if ($page <= 1) {
                                                                echo '#';
                                                            } else {
                                                                echo "?page=" . $prev;
                                                            } ?>"><span aria-hidden="true">&laquo;</span></a>

                            </li>

                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php if ($page == $i) {
                                                            echo 'active';
                                                        } ?>">
                                <a class="page-link" href="<?php echo $nombrePagina ?>?page=<?= $i; ?>"> <?= $i; ?> </a>
                            </li>
                            <?php endfor; ?>

                            <li class="page-item <?php if ($page >= $totalPages) {
                                                        echo 'disabled';
                                                    } ?>">
                                <a class="page-link" href="<?php if ($page >= $totalPages) {
                                                                echo '#';
                                                            } else {
                                                                echo "?page=" . $next;
                                                            } ?>"><span aria-hidden="true">&raquo;</span></a>
                            </li>
                        </ul>
                    </nav>
                    <!-- Pagination -->

                </div>
            </div>

            <!-- Footer -->
            <?php

            include $_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_COMPONENTES . "footer.php";
            ?>
            <!-- Footer -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>¿El estudiante será aceptado o
                                    rechazado?</strong>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <form action="<?php echo CARPETA_RAIZ . RUTA_PROCEDIMIENTOS . "respuestaVacante.php?a=1" ?>"
                                method="POST">
                                <button type="submit" class="btn btn-outline-primary" style="width: 132px;"
                                    data-toggle="modal" data-target="#aceptarModal">Aceptado</button>
                                &nbsp;o&nbsp;
                                <input type="hidden" id="docEstudiante1" name="docEstudiante1">
                                <input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $idUsuario ?>">
                                <button type="button" class="btn btn-outline-primary" style="width: 132px;"
                                    data-toggle="modal" data-target="#rechazarModal">Rechazado</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->

        <!-- Modal -->
        <div class="modal fade" id="rechazarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><strong>¿Cual es la razón del rechazo del
                                estudiante?</strong>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo CARPETA_RAIZ . RUTA_PROCEDIMIENTOS . 'respuestaVacante.php?a=0'  ?>"
                            method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="bmd-label-floating">
                                        Razón</label>
                                    <br>
                                    <textarea class="form-control" maxlength="950" name="razon" id="razon"
                                        rows="8"></textarea>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <input type="hidden" id="docEstudiante2" name="docEstudiante2">
                                    <input type="hidden" id="idEmpresa" name="idEmpresa"
                                        value="<?php echo $idUsuario ?>">
                                    <center><button type="submit" class="btn btn-outline-primary"
                                            style="width: 132px;">Finalizar</button></center>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->

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
    <script>
    $(document).ready(function() {
        $('#records-limit').change(function() {
            $('form').submit();
        })
    });
    </script>
</body>

</html>