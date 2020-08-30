<?php

include '../../EnvioCorreo.php';

$claseCorreo = new EnvioCorreo();
$claseCorreo->prepararCorreo("jsvargasq@unbosque.edu.co", "PRUEBA NUEVA", "HOLA QUE TAL?");
$claseCorreo->enviarCorreo();