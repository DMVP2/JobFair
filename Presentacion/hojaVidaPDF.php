<?php

session_start();

if (!isset($_SESSION['usuario'])) {

  header("location:../index.php");
}

include_once('../rutas.php');
include_once('../Persistencia/Conexion.php');
include_once('../Negocio/ManejoEstudiante.php');
include_once('../Negocio/ManejoHojaDeVida.php');

require_once $_SERVER['DOCUMENT_ROOT'] . "/" . CARPETA_RAIZ . RUTA_PRESENTACION . 'lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new DOMPDF();

function file_get_contents_curl($url) {
    $crl = curl_init();
    $timeout = 5;
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

$dompdf->load_html(file_get_contents('Hoja de vida.html'));

$options = $dompdf->getOptions();
$options->setIsHtml5ParserEnabled(true);
$dompdf->setOptions($options);

$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("mi_archivo.pdf");

?>