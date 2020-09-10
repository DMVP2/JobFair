<?php

session_start();

if (!isset($_SESSION['usuario'])) {

  header("location:../index.php");
}

// Importación de clases

include_once('../rutas.php');
include_once('../Persistencia/Conexion.php');
include_once('../Negocio/ManejoEstudiante.php');
include_once('../Negocio/ManejoHojaDeVida.php');

// Conexión con la base de datos

$c = Conexion::getInstancia();
$conexion = $c->conectarBD();

// Ejecución de métodos (Manejos)

$idUsuario = $_SESSION['usuario'];
$manejoEstudiantes = new ManejoEstudiante($conexion);
$estudiante = $manejoEstudiantes->buscarEstudiante($idUsuario);

$manejoHojaVida = new ManejoHojaDeVida($conexion);
$hojaVida = $manejoHojaVida->buscarHojaVida($idUsuario);

// Variables procedentes del estudiante

$nombre = $estudiante->getNombre();
$documento = $estudiante->getTipoDeDocumento() . " " . $estudiante->getNumeroDocumento();
$edad = $estudiante->getEdad();
$telefono = $estudiante->getTelefono();
$correo = $estudiante->getCorreo();
$carrera = $estudiante->getProgramaAcademico();

// Variables procedentes de la hoja de vida

$perfilProfesional = $hojaVida->getPerfilProfesional();
$certificaciones = $hojaVida->getCertificaciones();
$idiomas = $hojaVida->getIdiomas();
$experiencias = $hojaVida->getExperienciaLaboral();
$estudios = $hojaVida->getEstudios();
$referencias = $hojaVida->getReferenciasPersonales();

require("lib/fpdf/fpdf.php");
$pdf = new FPDF();

$pdf->AddPage();



$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(190, 10, 'Hoja de vida', 0, 0, 'C');
$pdf->Ln(8);

// Titulo
$rutaImagen = "img/Estudiante/" . $estudiante->getRutaFoto();

$pdf->Image($rutaImagen, 85, 30, 40, 55);

$pdf->SetFont("Arial", "B", 18);

$pdf->Ln(80);

// Información básica

$pdf->SetFillColor(245, 132, 31);
$pdf->Cell(190, 10, utf8_decode("Información básica"), 0, 1, 'C', true);
$pdf->Ln(14);
$pdf->Cell(65, 10, "Nombre:", 0, 0);
$pdf->Multicell(125, 10, utf8_decode($nombre), 0, 1);
$pdf->Cell(65, 10, "Documento:", 0, 0);
$pdf->Cell(125, 10, utf8_decode($documento), 0, 1);
$pdf->Cell(65, 10, "Edad:", 0, 0);
$pdf->Cell(125, 10, $edad, 0, 1);
$pdf->Cell(65, 10, utf8_decode("Teléfono:"), 0, 0);
$pdf->Cell(125, 10, $telefono, 0, 1);
$pdf->Cell(65, 10, utf8_decode("Correo Electrónico:"), 0, 0);
$pdf->Cell(125, 10, utf8_decode($correo), 0, 1);

$pdf->Ln(14);

// Perfil profesional y certificaciones

$pdf->SetFillColor(245, 132, 31);
$pdf->Cell(190, 10, "Perfil profesional", 0, 1, 'C', true);
$pdf->Ln(14);
$pdf->Multicell(185, 10, utf8_decode($perfilProfesional));
$pdf->Ln(14);
$pdf->SetFillColor(245, 132, 31);
$pdf->Cell(190, 10, "Certificaciones", 0, 1, 'C', true);
$pdf->Ln(14);
$pdf->Multicell(185, 10, utf8_decode($certificaciones));

$pdf->Ln(14);

// Idiomas

$pdf->SetFillColor(245, 132, 31);
$pdf->Cell(190, 10, "Idiomas", 0, 1, 'C', true);
$pdf->Ln(14);

$pdf->SetFillColor(132, 174, 64);
$pdf->Cell(95, 10, "Idioma", 0, 0, 'C', true);
$pdf->Cell(95, 10, "Nivel", 0, 1, 'C', true);

foreach ($idiomas as $idioma) {

  $lengua = $idioma[0];
  $nivel = $idioma[1];

  $pdf->Cell(95, 10, utf8_decode($lengua), 0, 0, 'C');
  $pdf->Cell(95, 10, utf8_decode($nivel), 0, 1, 'C');
}

$pdf->Ln(14);

// Experiencia laboral

$pdf->SetFillColor(245, 132, 31);
$pdf->Cell(190, 10, "Experiencia laboral", 0, 1, 'C', true);
$pdf->Ln(14);

foreach ($experiencias as $experiencia) {

  $cargo = $experiencia[0];
  $descripcion = $experiencia[1];
  $empresa = $experiencia[2];
  $fecha = $experiencia[3];

  $pdf->SetFillColor(132, 174, 64);
  $pdf->Multicell(190, 10, utf8_decode($fecha), 0, 1, 'L', true);
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Multicell(190, 10, utf8_decode($cargo), 0, 1, 'L', true);
  $pdf->Multicell(190, 10, utf8_decode($descripcion), 0, 1, 'L', true);
  $pdf->Multicell(190, 10, utf8_decode($empresa), 0, 1, 'L', true);
  $pdf->Ln(10);
}

// Estudios

$pdf->SetFillColor(245, 132, 31);
$pdf->Cell(190, 10, "Estudios", 0, 1, 'C', true);
$pdf->Ln(14);

foreach ($estudios as $estudio) {

  $nombre = $estudio[0];
  $area = $estudio[1];
  $intitucion = $estudio[2];
  $nivel = $estudio[3];
  $fecha = $estudio[4];

  $pdf->SetFillColor(132, 174, 64);
  $pdf->Multicell(190, 10, utf8_decode($fecha), 0, 1, 'L', true);
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Multicell(190, 10, utf8_decode($area) . " - " . utf8_decode($nivel), 0, 1, 'L', true);
  $pdf->Multicell(190, 10, utf8_decode($nombre), 0, 1, 'L', true);
  $pdf->Multicell(190, 10, utf8_decode($intitucion), 0, 1, 'L', true);
  $pdf->Ln(10);
}

// Referencias personales

$pdf->SetFillColor(245, 132, 31);
$pdf->Cell(190, 10, "Referencias personales", 0, 1, 'C', true);
$pdf->Ln(14);

foreach ($referencias as $referencia) {

  $nombre = $referencia[0];
  $telefono = $referencia[1];
  $parentesco = $referencia[2];

  $pdf->SetFillColor(132, 174, 64);
  $pdf->Multicell(190, 10, utf8_decode($nombre), 0, 1, 'L', true);
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Multicell(190, 10, utf8_decode($telefono), 0, 1, 'L', true);
  $pdf->Multicell(190, 10, utf8_decode($parentesco), 0, 1, 'L', true);
  $pdf->Ln(10);
}

$pdf->output();