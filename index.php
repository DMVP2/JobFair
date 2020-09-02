<?php include_once('./rutas.php') ?>

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
</head>

<body>
    <div class="wrapper ">

        <div class="content" align="center">
            <div class="container-fluid">

                <!-- CONTENIDO PAGINA -->

                <div class="card">
                    <div class="card card-header ">
                        <h2 class="card-title card-header-primary">FERIA DE OPORTUNIDADES</h2>
                    </div>

                    <div class="card-body">

                        <br>
                        <img class="img" width="50%" src="Presentacion/images/banner3.png" />

                        <div>
                            <br>
                            <br>
                            <button type="submit" class="btn btn-primary"
                                onclick="window.location.href='Presentacion/login.php'">Iniciar Sesión</button>
                            <button type="submit" class="btn btn-primary">Crear Cuenta</button>
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
    include "Presentacion/components/footer.php";
    ?>
    <!-- Footer -->
</body>

</html>