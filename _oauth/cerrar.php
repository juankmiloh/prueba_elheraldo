<?php
// Incuir el archivo FB config
require_once 'fbConfig.php';

$token = $_SESSION['facebook_access_token'];

$url = "http://facebook.com/logout.php?next=https://elheraldo.centralus.cloudapp.azure.com/prueba_elheraldo_juan/_oauth/&access_token=".$token;

// // Deshacer la información del usuario y la sesion
session_destroy();

// Redireccionar a página de inicio
// header("Location:index.php");
header('Location: '.$url);
?>