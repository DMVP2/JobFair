<?php

include_once('./rutas.php');

$_SESSION['index'] = 1;

$numero = rand(1, 6);
$ruta = "";

if ($numero <= 3) {
    $ruta = "banner1.png";
} else if ($numero == 4 or $numero == 5) {
    $ruta = "banner2.png";
} else {
    $ruta = "banner3.png";
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
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <link href="Presentacion/assets/css/material-dashboard.css" rel="stylesheet" />

    <!-- SCRIPTS BOOSTRAP -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</head>

<body>
    <div class="wrapper ">

        <div class="content" align="center">
            <div class="container-fluid">

                <!-- CONTENIDO PAGINA -->

                <div class="card">
                    <br>
                    <div class="card-title card-header-primary">
                        <strong>
                            <h2 class="card-category text-center" style="font-size:40px">FERIA DE OPORTUNIDADES</h2>
                        </strong>
                    </div>

                    <div class=" card-body">
                        <br>
                        <img class="img" width="60%" src="<?php echo CARPETA_RAIZ . RUTA_IMAGENES_WEB . $ruta ?>" />

                        <div>
                            <br>
                            <br>
                            <button type="submit" class="btn btn-primary"
                                onclick="window.location.href='<?php echo RUTA_PRESENTACION . 'login.php' ?>'">Iniciar
                                Sesión</button>
                            <button type="submit" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">Crear
                                Cuenta</button>

                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>



            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel"><strong>¿Eres Estudiante o eres una Empresa?</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <button type="button" class="btn btn-outline-primary" style="width: 132px;"
                        onclick="window.location.href='Presentacion/registroEstudiante.php'">ESTUDIANTE</button>
                    &nbsp;o&nbsp;
                    <button type="button" class="btn btn-outline-primary" style="width: 132px;"
                        onclick="window.location.href='Presentacion/registroEmpresa.php'">EMPRESA</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->


</body>

</html>