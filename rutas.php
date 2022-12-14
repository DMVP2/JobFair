<?php

define('CARPETA_RAIZ', '/Softlutions/');

define('RUTA_NEGOCIO', 'Negocio/');
define('RUTA_ENTIDADES', 'Negocio/Entidades/');
define('RUTA_NEGOCIO_LIB', 'Negocio/lib/');
define('RUTA_MANEJOS', 'Negocio/Manejos/');

define('RUTA_PERSISTENCIA', 'Persistencia/');

define('RUTA_ASSETS', 'Presentacion/assets/');

define('RUTA_PRESENTACION', 'Presentacion/');
define('RUTA_COMPONENTES', 'Presentacion/componentes/');
define('RUTA_PROCEDIMIENTOS', 'Presentacion/procedimientos/');

define('RUTA_PORTALES', 'Presentacion/portales/');
define('RUTA_INFORMACION', 'Presentacion/informacion/');
define('RUTA_TABLAS', 'Presentacion/tablas/');
define('RUTA_EDITAR', 'Presentacion/editar/');
define('RUTA_CAMPOS', 'Presentacion/campos/');
define('RUTA_PRESENTACION_LIB', 'Presentacion/lib/');
define('RUTA_REPORTES', 'Presentacion/reportes/');

define('RUTA_IMAGENES', 'Presentacion/imagenes/');
define('RUTA_IMAGENES_WEB', 'Presentacion/imagenes/banner/');
define('RUTA_DOCUMENTOS', 'Presentacion/documentos/');

define('RUTA_SESION', 'Sesion/');

define('ARCHIVO_PARAMETRIZACION_CORREO', '/Persistencia/parametrizacionCorreos.php');


header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works

session_start();