<?php
if(!session_id()){
    session_start();
}

// Incluir el autoloader del the SDK
require_once __DIR__ . '/facebook-php-sdk/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

/*
 * Configuración de Facebook SDK
 */
$appId         = '1024718441685073'; // Identificador de la Aplicación
$appSecret     = 'bbf7f735dcda6a3dc96e29d49896d047'; // Clave secreta de la aplicación
// $redirectURL   = 'http://localhost/prueba_elheraldo_juan/'; // Callback URL localhost
$redirectURL   = 'https://elheraldo.centralus.cloudapp.azure.com/prueba_elheraldo_juan/'; //Callback URL AZURE
$fbPermissions = array('');  //Permisos opcionales

$fb = new Facebook(array(
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.9',
));

// Obtener el apoyo de logueo
$helper = $fb->getRedirectLoginHelper();

// Try para obtener el token
try {
    if(isset($_SESSION['facebook_access_token'])){
        $accessToken = $_SESSION['facebook_access_token'];
    }else{
          $accessToken = $helper->getAccessToken();
    }
} catch(FacebookResponseException $e) {
     echo 'Graph returned an error: ' . $e->getMessage();
      exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
}

?>