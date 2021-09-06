<?php

header("access-control-allow-origin: *");
require_once './../util/bdConnection.php';

$idusuario = $_POST['idusuario'];

// echo json_encode($_FILES["file"]);

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ". ";
    $uploadOk = 1;
  } else {
    echo "El archivo no es una imagen. ";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Esta foto ya existe. ";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 50000000000000000000000000) {
  echo "El tamaño de la foto es demasiado grande. ";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Lo siento, solo se admiten formatos JPG, JPEG, PNG & GIF. ";
  $uploadOk = 0;
}

$sql="SELECT * FROM foto WHERE oauth_uid=".$idusuario;
$result=mysqli_query($con, $sql);
$rowcount=mysqli_num_rows($result);

// echo 'Numero de fotos cargadas -> '.$rowcount;

if($rowcount >= 2){ // El usuario ha cargado sus dos fotos
    echo "Ya cargo sus dos fotos permitidas.";
} else { // El usuario no ha cargado sus dos fotos
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) { // Si la foto no es valida
        echo "Su foto no pudo ser cargada. ";
    // if everything is ok, try to upload file
    } else { // Si la foto es valida
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $sql="INSERT INTO foto SET oauth_uid = '".$idusuario."', nombre = '".$_FILES["file"]["name"]."'";
            if (mysqli_query($con,$sql) == true){
                echo 'La foto "'. htmlspecialchars( basename( $_FILES["file"]["name"])). '" ha sido guardada con éxito. ';
            } else {
                echo $con->error."\nerror: ". $sql . "<br>";
            }
        } else {
            echo "Lo siento, hubo un error subiendo su foto. ";
        }
    }
}
?>