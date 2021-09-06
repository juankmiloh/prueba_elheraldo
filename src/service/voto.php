<?php
header("access-control-allow-origin: *");
require_once './../util/bdConnection.php';

$data = $_POST['data'];

// echo $data[0]['id_usuario_voto'];

$sql="SELECT * FROM voto WHERE id_usuario_voto=".$data[0]['id_usuario_voto'];
$result=mysqli_query($con, $sql);
$rowcount=mysqli_num_rows($result);

if($rowcount == 0){
    // El usuario no ha votado
    $sql="INSERT INTO voto SET idfoto = '".$data[0]['idfoto']."', id_usuario_voto = '".$data[0]['id_usuario_voto']."'";
    // $sql="insert into voto (idfoto, id_usuario_voto) values ('".$data[0]['idfoto']."', '".$data[0]['id_usuario_voto']."')";
    if (mysqli_query($con,$sql) == true){
        echo "true";
    }else{
        echo $con->error."\nerror: ". $sql . "<br>";
    }
} else {
    echo "false";
}
// echo json_encode($data);
?>