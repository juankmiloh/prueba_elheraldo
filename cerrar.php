<?php
// Incuir el archivo FB config
require_once 'fbConfig.php';

// // Deshacer la sesión
// unset($_SESSION['facebook_access_token']);

// // Deshacer la información del usuario
// unset($_SESSION['userData']);

// $url = 'https://www.facebook.com/logout.php?next='.'http://localhost/fb_login/'.'&access_token='.$_SESSION['facebook_access_token'];

// $token = $_SESSION['facebook_access_token'];
// $url = 'https://www.facebook.com/logout.php?next=' . 'https%3A%2F%2Fwww.facebook.com%2Fhome.php/' .
//   '&access_token='.$token.'&logout=true';

//   "http://m.facebook.com/logout.php?client_id=10158639698551589"

//   print($url);


// header('Location: '.$url);
// $url = "http://facebook.com/logout.php?next=http://localhost/fb_login&access_token=".$_SESSION['facebook_access_token'];
// print($url);
session_destroy();
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
// Redireccionar a página de inicio
header("Location:index.php");
// header('Location: '.$url);

?>