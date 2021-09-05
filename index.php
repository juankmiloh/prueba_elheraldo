<?php
// Include FB config file && User class
require_once './src/oauth/fbConfig.php';
require_once './src/oauth/usuarios.php';

session_start();
session_regenerate_id(true);

if(isset($accessToken)){
    if(isset($_SESSION['facebook_access_token'])){
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
        // Token de acceso de corta duración en sesión
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        
          // Controlador de cliente OAuth 2.0 ayuda a administrar tokens de acceso
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Intercambia una ficha de acceso de corta duración para una persona de larga vida
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        
        // Establecer token de acceso predeterminado para ser utilizado en el script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    
    // Redirigir el usuario de nuevo a la misma página si url tiene "code" parámetro en la cadena de consulta
    if(isset($_GET['code'])){
        header('Location: ./src/views/photoViewer.php');
    }
    
    // Obtener información sobre el perfil de usuario facebook
    try {
        $profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
        $fbUserProfile = $profileRequest->getGraphNode()->asArray();
        // print("Datos usuario --> ".json_encode($fbUserProfile));
        // echo "IP Local: " . $_SERVER['SERVER_ADDR'];
        // echo $_SERVER['HTTP_FORWARDED_FOR'];
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // Redirigir usuario a la página de inicio de sesión de la aplicación
        header("Location: ./");
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    
    // Inicializar clase "user"
    // $user = new User();
    
    // datos de usuario que iran a  la base de datos
    $fbUserData = array(
        'oauth_provider'=> 'facebook',
        'oauth_uid'     => $fbUserProfile['id'],
        'first_name'    => $fbUserProfile['first_name'],
        'last_name'     => $fbUserProfile['last_name'],
        'email'         => $fbUserProfile['email'],
        'gender'        => $fbUserProfile['gender'],
        'locale'        => $fbUserProfile['locale'],
        'picture'       => $fbUserProfile['picture']['url'],
        'link'          => $fbUserProfile['link']
    );
    // $userData = $user->checkUser($fbUserData);
    
    // Poner datos de usuario en variables de Session
    $_SESSION['userData'] = $fbUserData;
    
    // Obtener el url para cerrar sesión
    // $logoutURL = $helper->getLogoutUrl($accessToken, $redirectURL.'cerrar.php');
    
    // imprimir datos de usuario
    // if(!empty($_SESSION['userData'])){

    //     $userInfo= 
    //     '<div class="col-md-offset-3 col-md-6">
    //     <table class="table table-responsive" style="background-color:rgba(255, 255, 255, 0.3); border: 2px #a0bbe8 solid;">
    //         <h4 class="bg-primary text-center pad-basic">INFORMACIÓN DEL USUARIO</h4>
    //         <tr><th>Miniatura de Perfil:</th><td><img src="'.$userData['picture'].'"></td></tr>
    //         <tr><th>Nombre:</th><td>' . $userData['first_name'].' '.$userData['last_name'].'</td></tr>
    //         <tr><th>Correo:</th><td>' . $userData['email'].'</td></tr>
    //         <tr><th>Género:</th><td>' . $userData['gender'].'</td></tr>
    //         <tr><th>Ubicación:</th><td>' . $userData['locale'].'</td></tr>
    //         <tr><th>Logueado con: </th><td> Facebook </td></tr>
    //         <tr><th>Cerrar Sesión de:</th><td><a class="btn btn-primary" href="'.$logoutURL.'"> Facebook</a></td></tr>
    //     </table>
    //     </div>';
    // }else{
    //     $output = '<h3 style="color:red">Ocurrió algún problema, por favor intenta nuevamente.</h3>';
    // }
    
}else{
    // Obtener la liga de inicio de sesión
    $loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
    
    // imprimir botón de login
    $output = '<a href="'.htmlspecialchars($loginURL).'"><div class="col-md-6 col-md-offset-4"><img class="img-responsive" src="./src/assets/fblogin-btn.png"></a></div>';
}
?>
<html lang="es">
<head>
<title>Descubre a Barranquilla</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="shortcut icon" href="./src/assets/marketing.ico" type="image/vnd.microsoft.icon">
    <!-- Bootstrap CSS -->
    <link href="./src/styles/bootstrap.min.css" rel="stylesheet">
    <link href="./src/styles/estilos.css" rel="stylesheet">
    <script src="./src/js/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="./src/js/bootstrap.min.js"></script>
    <script src="./src/controller/oauth.js"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark w-100" style="position: absolute; z-index: 10; background: #0a244f !important;">
        <div class="container-fluid">
            <!-- <h2 style="color: white;">Descubre a Barranquilla</h2> -->
            <div class="row w-100" style="border: 0px solid yellow; padding-top: 0.5%; padding-bottom: 0.5%;">
                <div class="col-sm-12 col-md-6 logo-colombia">
                    <img class="img-responsive" src="./src/assets/logo-ct-es.webp" height="50">
                </div>
                <div class="col-sm-12 col-md-6 login">
                    <?php
                        echo '<a href="'.htmlspecialchars($loginURL).'"><img src="./src/assets/fblogin-btn.png" height="50"></a>';
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <div style="border: 0px solid red;" class="w-100 h-100">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="./src/assets/quilla8.jpg" class="d-block w-100 h-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="w-100 h-100" style="border: 0px solid; text-align: center;">
                        <img src="./src/assets/el-heraldo-logo.svg" class="w-50 h-50" alt="...">
                    </div>
                    <h1>Descubre a Barranquilla</h1>
                    <h5>Participa en el concurso</h5>
                </div>
                </div>
                <div class="carousel-item">
                <img src="./src/assets/quilla5.jpg" class="d-block w-100 h-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="w-100 h-100" style="border: 0px solid; text-align: center;">
                        <img src="./src/assets/el-heraldo-logo.svg" class="w-50 h-50" alt="...">
                    </div>
                    <h1>Descubre a Barranquilla</h1>
                    <h5>Participa en el concurso</h5>
                </div>
                </div>
                <div class="carousel-item">
                <img src="./src/assets/quilla3.jpg" class="d-block w-100 h-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="w-100 h-100" style="border: 0px solid; text-align: center;">
                        <img src="./src/assets/el-heraldo-logo.svg" class="w-50 h-50" alt="...">
                    </div>
                    <h1>Descubre a Barranquilla</h1>
                    <h5>Participa en el concurso</h5>
                </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Mostrar información del perfil y botón de login -->
    <div><?php echo $userInfo; ?></div>
</body>
</html>