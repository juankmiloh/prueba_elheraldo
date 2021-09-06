<?php
    include('./../util/bdConnection.php');
    session_start();
    $logoutURL = '../oauth/cerrar.php';
    $userData = $_SESSION['userData'];
    if(!isset($_SESSION['userData'])){
        header('Location: ../../index.php');
    }
?>

<html lang="es">
<head>
<title>Descubre a Barranquilla</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="shortcut icon" href="../assets/marketing.ico" type="image/vnd.microsoft.icon">
    <!-- Bootstrap CSS -->
    <link href="../styles/bootstrap.min.css" rel="stylesheet">
    <link href="../styles/estilos.css" rel="stylesheet">
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../controller/controllerPhotoViewer.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark w-100" style="background: #0a244f !important;">
        <div class="row w-100">
            <div class="col-sm-12 col-md-10 logo-colombia" style="border: 0px solid red;">
                <img class="img-responsive" src="../assets/logo-ct-es.webp" height="50">
            </div>
            <div class="col-sm-12 col-md-2 logout-md" style="border: 0px solid red; padding: 0;">
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span style="color: white;"><?php echo $userData['first_name'].' '.$userData['last_name'];?></span>
                                <img src="<?php echo $userData['picture'];?>" alt="Avatar" class="avatar" style="margin-left: 3%;">
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
                <a href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="btn btn-primary">Subir fotos</a>
                <?php
                    echo '<a href="'.htmlspecialchars($logoutURL).'"><img src="../assets/close.png" height="39"></a>';
                ?>
            </div>
        </div>
    </nav>
    
    <!-- Menu lateral de carga de fotos -->
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <nav class="navbar navbar-dark bg-dark w-100" style="background-color: #0a244f !important; color: white;">
            <h3 style="padding-top: 2%; padding-left: 5%;" id="offcanvasRightLabel">Carga tus fotos al concurso</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </nav>
        <div class="offcanvas-body" style="text-align: center;">
            <h5 style="padding-bottom: 4%;">Podrás cargar solo dos fotos</h5>    
            <div style="border-top: 1px solid #cfd8dc; padding-bottom: 6%;"></div>

            <div class="mb-3" style="padding-bottom: 2%;">
                <input class="form-control form-control-sm" type="file" name="sortpic" id="sortpicture" accept="image/png,image/jpeg">
            </div>
            <div style="border-top: 1px solid #cfd8dc; padding-bottom: 6%;"></div>
            <?php
                echo '<a href="javascript:guardarImagen('.htmlspecialchars(json_encode($userData['oauth_uid'])).')" class="btn btn-primary">Subir foto</a>';
            ?>
        </div>
    </div>

    <!-- Contenedro para mostrar las imagenes del concurso -->

    <div class="container" style="padding-top: 3%; border: 0px solid red;">
        <!-- Content here -->

        <div class="row container-photos">
        <?php
            // Consulta que permite obtener las fotografias con su respectiva votacion
            $sql = "select f.*, (case when votos.cantidad is not null then votos.cantidad else 0 end) as cantidad from
            (select u.oauth_uid as id, u.picture, concat(u.first_name, ' ',last_name) as nombre, f.idfoto, f.nombre as foto from foto f, users u where f.oauth_uid = u.oauth_uid) f
            left join
            (select v.idfoto, count(*) as cantidad from voto v, foto f where v.idfoto = f.idfoto group by v.idfoto) votos
            on f.idfoto=votos.idfoto
            order by votos.cantidad desc";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $votoData = array();
                $votoData[] = array(
                    'idfoto'          => $row['idfoto'],
                    'id_usuario_voto' => $userData['oauth_uid']
                );
        ?>  
            <div class="col-sm-12 col-md-3" style="padding-bottom: 2.5%;">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo './../service/uploads/'.$row['foto'];?>" class="card-img-top" alt="..." height="220">
                    <div class="card-body" style="border-top: 1px solid #cfd8dc;">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="<?php echo $row['picture'];?>" alt="Avatar" class="avatar">
                            </div>
                            <div class="col-md-9" style="padding-top: 4%;">
                                <h5 class="card-title" style="font-size: large;"><?php echo $row['nombre'];?></h5>
                            </div>
                        </div>
                        <div style="padding-bottom: 3%; text-align: center; font-weight: 600;">
                            <p class="card-text">Cantidad de votos: <?php echo $row['cantidad'];?></p>
                        </div>
                        <div style="border-top: 1px solid #cfd8dc; padding-bottom: 4%;"></div>
                        <div class="text-center">
                            <?php
                                echo '<a href="javascript:guardarVoto('.htmlspecialchars(json_encode($votoData)).')" class="btn btn-primary" style="font-weight: 500;">Votar</a>';
                            ?>
                            <?php
                                if ($userData['oauth_uid'] == $row['id']) {
                                    $fotoData = array();
                                    $fotoData[] = array(
                                        'idfoto' => $row['idfoto'],
                                        'nombre' => $row['foto']
                                    );
                                    echo '
                                        <a href="javascript:eliminarFoto('.htmlspecialchars(json_encode($fotoData)).')" class="btn btn-danger" style="color: white; font-size: x-large;">
                                            <i class="bi bi-trash"></i>
                                        </a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
</body>
</html>