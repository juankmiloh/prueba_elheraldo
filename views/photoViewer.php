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
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark w-100" style="background: #0a244f !important;">
        <div class="row w-100">
            <div class="col-sm-6 col-md-10 logo-colombia" style="border: 0px solid red;">
                <img class="img-responsive" src="../img/logo-ct-es.webp" height="50">
            </div>
            <div class="col-sm-12 col-md-2 logout-md">
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span style="color: white;"><?echo $userData['first_name'].' '.$userData['last_name'];?></span>
                            <img src="<?echo $userData['picture'];?>" alt="Avatar" class="avatar" style="margin-left: 10%;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Subir fotos</a></li>
                            <?php
                                echo '<li><a class="dropdown-item" href="'.htmlspecialchars($logoutURL).'">Salir</a></li>';
                            ?>
                        </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 logout-sm" style="border: 0px solid yellow;">
                <?php
                    echo '<a href="'.htmlspecialchars($logoutURL).'"><img src="../img/close.png" height="50"></a>';
                ?>
            </div>
        </div>
    </nav>
    
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Carga tus fotos al concurso</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            ...
        </div>
    </div>

    
</body>
</html>