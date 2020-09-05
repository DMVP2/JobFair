<?php 
session_start();
 
if (!isset($_SESSION['usuario'])) 
{
    header("location: ../index.php"); 
}
 
session_unset($_SESSION['usuario']);
 
session_destroy();
 
header("location: ../index.php");
?>