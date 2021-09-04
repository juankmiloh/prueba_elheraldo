<?php
    session_start();
    $logoutURL = '../_oauth/cerrar.php';
    $userData = $_SESSION['userData'];
    print("Datos usuario --> ".json_encode($userData));
?>

<html lang="es">
<head>
<title>Descubre a Barranquilla</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="shortcut icon" href="../img/marketing.ico" type="image/vnd.microsoft.icon">
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/estilos.css" rel="stylesheet">
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../controller/oauth.js"></script>
</head>
<body>
    <?
        echo 'IP Local: ' . $_SERVER['SERVER_ADDR'];
    ?>
    

    
</body>
</html>