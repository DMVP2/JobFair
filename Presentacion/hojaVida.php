<?php

session_start();
 
if (!isset($_SESSION['usuario'])) 
{
   
   header("location:../index.php"); 
}

// Importación de clases

include_once('../rutas.php');
include_once('../Persistencia/conexion.php');
include_once('../Negocio/ManejoEstudiante.php');
include_once('../Negocio/ManejoVacante.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

// Ejecución de métodos (Manejos)

$idUsuario = $_SESSION['usuario'];
$manejoEstudiantes = new ManejoEstudiante($conexion);
$estudiante = $manejoEstudiantes->buscarEstudiante($idUsuario);
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hoja de vida</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href= <?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "cv/" . "css/aos.css" ?> rel="stylesheet">
    <link href= <?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "cv/" . "css/bootstrap.min.css" ?> rel="stylesheet">
    <link href= <?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "cv/" . "styles/main.css" ?> rel="stylesheet">
  </head>
  <body id="top">
    <div class="page-content">
      <div>
<div class="profile-page">
  <div class="wrapper">
    <div class="page-header page-header-small" filter-color="green">
      <div class="page-header-image" data-parallax="true" style="background: rgb(62, 71, 41);"></div>
      <div class="container">
        <div class="content-center">
          <div class="cc-profile-image"><a href="#"><img src= <?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "cv/" . "images/anthony.jpg" ?> alt="Image"/></a></div>
          <div class="h2 title">Anthony Barnett</div>
          <p class="category text-white">Web Developer, Graphic Designer,  Photographer</p><a class="btn btn-primary" href="#" data-aos="zoom-in" data-aos-anchor="data-aos-anchor">PDF</a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section" id="about">
  <div class="container">
    <div class="card" data-aos="fade-up" data-aos-offset="10">
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card-body">
            <div class="h4 mt-0 title">Perfil profesional</div>
            <p>Hello! I am Anthony Barnett. Web Developer, Graphic Designer and Photographer.</p>
            <p>Creative CV is a HTML resume template for professionals. Built with Bootstrap 4, 
              Now UI Kit and FontAwesome, this modern and responsive design template is perfect to showcase your 
              portfolio, skills and experience.</p>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card-body">
            <div class="h4 mt-0 title">Información básica</div>
            <div class="row">
              <div class="col-sm-4"><strong class="text-uppercase">Age:</strong></div>
              <div class="col-sm-8">24</div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Email:</strong></div>
              <div class="col-sm-8">anthony@company.com</div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Phone:</strong></div>
              <div class="col-sm-8">+1718-111-0011</div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Address:</strong></div>
              <div class="col-sm-8">140, City Center, New York, U.S.A</div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Language:</strong></div>
              <div class="col-sm-8">English, German, French</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section" id="skill">
  <div class="container">
    <div class="h4 text-center mb-4 title">Idiomas</div>
    <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="progress-container progress-primary"><span class="progress-badge">HTML</span>
              <div class="progress">
                <div class="progress-bar progress-bar-primary" data-aos="progress-full" data-aos-offset="10" data-aos-duration="2000" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div><span class="progress-value">80%</span>
              </div>
            </div>
          </div>
        </div>  
        <div class="row">
          <div class="col-md-12">
            <div class="progress-container progress-primary"><span class="progress-badge">HTML</span>
              <div class="progress">
                <div class="progress-bar progress-bar-primary" data-aos="progress-full" data-aos-offset="10" data-aos-duration="2000" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div><span class="progress-value">80%</span>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
<div class="section" id="experience">
  <div class="container cc-experience">
    <div class="h4 text-center mb-4 title">Experiencia laboral</div>
    <div class="card">
      <div class="row">
        <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body cc-experience-header">
            <p>March 2016 - Present</p>
            <div class="h5">CreativeM</div>
          </div>
        </div>
        <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body">
            <div class="h5">Front End Developer</div>
            <p>Euismod massa scelerisque suspendisse fermentum habitant vitae ullamcorper magna quam iaculis, tristique sapien taciti mollis interdum sagittis libero nunc inceptos tellus, hendrerit vel eleifend primis lectus quisque cubilia sed mauris. Lacinia porta vestibulum diam integer quisque eros pulvinar curae, curabitur feugiat arcu vivamus parturient aliquet laoreet at, eu etiam pretium molestie ultricies sollicitudin dui.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section">
  <div class="container cc-education">
    <div class="h4 text-center mb-4 title">Educación</div>
    <div class="card">
      <div class="row">
        <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body cc-education-header">
            <p>2013 - 2015</p>
            <div class="h5">Master's Degree</div>
          </div>
        </div>
        <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body">
            <div class="h5">Master of Information Technology</div>
            <p class="category">University of Computer Science</p>
            <p>Euismod massa scelerisque suspendisse fermentum habitant vitae ullamcorper magna quam iaculis, tristique sapien taciti mollis interdum sagittis libero nunc inceptos tellus, hendrerit vel eleifend primis lectus quisque cubilia sed mauris. Lacinia porta vestibulum diam integer quisque eros pulvinar curae, curabitur feugiat arcu vivamus parturient aliquet laoreet at, eu etiam pretium molestie ultricies sollicitudin dui.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section" id="reference">
  <div class="container cc-reference">
    <div class="h4 mb-4 text-center title">Referencias personales</div>
    <div class="row">
      <div class="col-lg-2 col-md-3 cc-reference-header">
        <div class="h5 pt-2">Aiyana</div>
        <p class="category">CEO / WEBM</p>
      </div>
      <div class="col-lg-10 col-md-9">
        <p> Habitasse venenatis commodo tempor eleifend arcu sociis sollicitudin ante pulvinar ad, est porta cras erat ullamcorper volutpat metus duis platea convallis, tortor primis ac quisque etiam luctus nisl nullam fames. Ligula purus suscipit tempus nascetur curabitur donec nam ullamcorper, laoreet nullam mauris dui aptent facilisis neque elementum ac, risus semper felis parturient fringilla rhoncus eleifend.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-2 col-md-3 cc-reference-header">
        <div class="h5 pt-2">Aiyana</div>
        <p class="category">CEO / WEBM</p>
      </div>
      <div class="col-lg-10 col-md-9">
        <p> Habitasse venenatis commodo tempor eleifend arcu sociis sollicitudin ante pulvinar ad, est porta cras erat ullamcorper volutpat metus duis platea convallis, tortor primis ac quisque etiam luctus nisl nullam fames. Ligula purus suscipit tempus nascetur curabitur donec nam ullamcorper, laoreet nullam mauris dui aptent facilisis neque elementum ac, risus semper felis parturient fringilla rhoncus eleifend.</p>
      </div>
    </div>
  </div>
  </div>
</div>
    </div>
    <footer class="footer">
      <div class="h4 title text-center">Anthony Barnett</div>
      <div class="text-center text-muted">
        <p>&copy; Creative CV. All rights reserved.<br>Design - <a class="credit" href="https://templateflip.com" target="_blank">TemplateFlip</a></p>
      </div>
    </footer>
    <script src= <?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "cv/" . "js/core/jquery.3.2.1.min.js" ?> ></script>
    <script src= <?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "cv/" . "js/core/popper.min.js" ?> ></script>
    <script src= <?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "cv/" . "js/core/bootstrap.min.js" ?> ></script>
    <script src= <?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "cv/" . "js/now-ui-kit.js?v=1.1.0" ?> ></script>
    <script src= <?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "cv/" . "js/aos.js" ?> ></script>
    <script src= <?php echo "/" . CARPETA_RAIZ . RUTA_ASSETS . "cv/" . "scripts/main.js" ?> ></script>
  </body>
</html>