<?php
    session_start();
    $logoutURL = '../_oauth/cerrar.php';
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
<nav class="navbar navbar-dark bg-dark w-100" style="position: absolute; z-index: 10; background: #0a244f !important;">
        <div class="container-fluid">
            <!-- <h2 style="color: white;">Descubre a Barranquilla</h2> -->
            <div class="row w-100" style="border: 0px solid yellow; padding-top: 0.5%; padding-bottom: 0.5%;">
                <div class="col-sm-12 col-md-6 logo-colombia">
                    <img class="img-responsive" src="../img/logo-ct-es.webp" height="50">
                </div>
                <div class="col-sm-12 col-md-6 login">
                    <?php
                        echo '<a href="'.htmlspecialchars($logoutURL).'"><img src="../img/close.png" height="50"></a>';
                    ?>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Offcanvas right</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            ...
        </div>
    </div>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button> -->

    <br><br><br><br><br><br><br>

    <?
        print("Datos usuario --> ".json_encode($_SESSION['userData']));
    ?>


</body>
</html>