<?php

// Importación de clases

include_once('../rutas.php');
include_once('../Persistencia/conexion.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

// Ejecución de métodos (Manejos)

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
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="<?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "css/material-dashboard.css" ?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "css/style.css"  ?>">
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
            
            <section class="form-login">
              <h5>INICIAR SESIÓN</h5>
              <input class="controls" type="text" name="usuario" value="" placeholder="Usuario">
              <input class="controls" type="password" name="password" value="" placeholder="Contraseña">
              <input class="btn btn-primary" type="submit" name="" value="Iniciar sesión">
              <br>
              <br>
              <p><a href="#">¿Olvidaste tu Contraseña?</a></p>
              <p><a href="#">Volver</a></p>
            </section>
            
          </div>

        </div>

      </div>
    </div>

  </div>

  <!-- Footer -->
  <?php
  include "./components/footer.php";
  ?>
  <!-- Footer -->
</body>

</html>