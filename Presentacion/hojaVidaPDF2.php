<?php

session_start();

if (!isset($_SESSION['usuario'])) {

  header("location:../index.php");
}

include_once('../rutas.php');
include_once('../Persistencia/Conexion.php');
include_once('../Negocio/ManejoEstudiante.php');
include_once('../Negocio/ManejoHojaDeVida.php');

    require_once("nuSOAP/lib/nusoap.php");
    $client = new nusoap_client('http://produccion.developerji.com/ConvertirHtmlaPDF.asmx?wsdl',true, false, false, false, false, 0, 10000);
    $soapaction = "http://tempuri.org/ConvertirUrl_PDF";
    $namespace= "http://tempuri.org/";
    $client->soap_defencoding = 'UTF-8';
    $params = array();
    $params['url'] = 'http://php.net/';
    $params['usuario'] = 'jiestrada';
    $params['apikey'] = 'qF4OxILMDYXY6vQ';
    $result = $client->call('ConvertirUrl_PDF',$params,$namespace,$soapaction);
    $PDF=$result['ConvertirUrl_PDFResult'];    
    file_put_contents('C:\inetpub\wwwroot\llamarwsPHP\pdfprueba.pdf', base64_decode($PDF));    
    $err = $client->getError();
    if ($err) {
        echo 'Error';
    }
    header('Location: http://localhost/llamarwsPHP/pdfprueba.pdf');

?>