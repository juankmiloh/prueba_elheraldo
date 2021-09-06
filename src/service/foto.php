<?php
header("access-control-allow-origin: *");
require_once './../util/bdConnection.php';

$idfoto = $_POST['data'][0]['idfoto'];
$nombrefoto = $_POST['data'][0]['nombre'];

// echo json_encode($_POST);

//generamos la consulta
$sql = "DELETE FROM voto WHERE idfoto=".$idfoto;
if (mysqli_query($con,$sql) == true){
    $sql = "DELETE FROM foto WHERE idfoto=".$idfoto." AND nombre='".$nombrefoto."'";
    if (mysqli_query($con,$sql) == true){
        unlink("uploads/".$nombrefoto);
        echo "true";
    } else{
        echo "false";
    }
} else{
    echo "false";
}
    
//desconectamos la base de datos
$close = mysqli_close($con) or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
?>