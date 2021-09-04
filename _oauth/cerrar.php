<?php
// Incuir el archivo FB config
require_once 'fbConfig.php';

// // Deshacer la sesión
// unset($_SESSION['facebook_access_token']);

// // Deshacer la información del usuario
// unset($_SESSION['userData']);

// $token = $_SESSION['facebook_access_token'];

// $url = 'https://www.facebook.com/logout.php?next='.'http://localhost/fb_login/'.'&access_token='.$_SESSION['facebook_access_token'];

$url = "http://facebook.com/logout.php?next=https://elheraldo.centralus.cloudapp.azure.com/prueba_elheraldo_juan/_oauth/&access_token=".$_SESSION['facebook_access_token'];
print($url);
session_destroy();
// Redireccionar a página de inicio
// header("Location:index.php");
header('Location: '.$url);
?>