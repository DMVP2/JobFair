<?php


// Importación de clases

include_once('../../rutas.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . 'Conexion.php');
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_MANEJOS . 'manejoEmpresa.php');

// Nombre de la pagina

$nombrePagina = basename(__FILE__);

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();


// Ejecución de métodos (Manejos)

$idUsuario = $_SESSION['usuario'];
$manejoEmpresa = new ManejoEmpresa($conexion);

// Paginación

if (isset($_POST['records-limit'])) {
    $_SESSION['records-limit'] = $_POST['records-limit'];
}

$limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 10;
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$paginationStart = ($page - 1) * $limit;

// RETORNA EL ARREGLO DE LA BD

$nombre = "";

if(isset($_POST['nombre'])) {

    $nombre = $_POST['nombre'];
  }
  if($nombre != null) {

    $empresas = $manejoEmpresa->listaFiltrada($paginationStart, $limit, $nombre);
  } else {
    $empresas = $manejoEmpresa->listarEmpresasPaginacion($paginationStart, $limit);
  }


// CANTIDAD TOTAL A CARGAR - COUNT BD

$allRecords = $manejoEmpresa->cantidadEmpresas();

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
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
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


                    <form class="user" method="post">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Filtrar por nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>
                    </form>

 <!-- Select dropdown -->
 <div class="d-flex flex-row-reverse bd-highlight mb-3">
                            <form action="<?php echo $nombrePagina ?>" method="post">
                                <select name="records-limit" id="records-limit" class="custom-select">
                                    <option disabled selected>Límite</option>
                                    <?php foreach ([5, 10, 15, 20] as $limit) : ?>
                                        <option <?php if (isset($_SESSION['records-limit']) && $_SESSION['records-limit'] == $limit) echo 'selected'; ?> value="<?= $limit; ?>">
                                            <?= $limit; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                        </div>
                        <!-- Select dropdown -->


                        <?php
                        foreach ($empresas as $empresa) {

                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <center><?php echo $empresa->getRazonSocial() ?></center>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <img class="img" width="40%" src="<?php echo CARPETA_RAIZ . RUTA_IMAGENES . "Empresa/" . $empresa->getLogoEmpresa() ?>" />
                                            <br><br>
                                            <h6 class="card-title"><?php echo $empresa->getRazonComercial() ?>
                                            </h6>
                                        </div>
                                        <div class="col-md-8">

                                            <p class="card-text">
                                                <?php
                                                if (strlen($empresa->getDescripcion()) > 290) {
                                                    echo substr($empresa->getDescripcion(), 0, 290) . "....";
                                                } else {
                                                    echo $empresa->getDescripcion();
                                                }

                                                ?>
                                            </p>
                                        </div>
                                        <div class="col-sm-2">
                                            <br><br>
                                            <form action="informacionEmpresa.php" method="post">
                                                <input class="btn btn-primary" type="hidden" id=<?php echo "'" . $empresa->getNit() . "'"; ?> name="idEmpresa" value=<?php echo "'" . $empresa->getNit() . "'"; ?>>
                                                <input class="btn btn-primary" type="submit" id="submit" name="empresa" value="Ver mas">
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

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
        <script src="<?php echo CARPETA_RAIZ . RUTA_ASSETS . "js/material-dashboard.js?v=2.1.2" ?> type=" text/javascript"> </script> <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
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