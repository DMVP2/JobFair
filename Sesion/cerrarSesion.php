<?php 
session_start();
 
if (!isset($_SESSION['alumno'])) 
{
    header("location: ../index.php"); 
}
 
session_unset($_SESSION['alumno']);
 
session_destroy();
 
header("location: ../index.php");
 ?>


// //abrimos la sesión
session_start();
 
//Si la variable sesión está vacía
if (!isset($_SESSION['alumno'])) 
{
   /* nos envía a la siguiente dirección en el caso de no poseer autorización */
   header("location:../index.php"); 
}