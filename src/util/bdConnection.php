<?php
$con = mysqli_connect("elheraldo.centralus.cloudapp.azure.com", "root", "root", "elheraldo", "3306");
// Check connection
mysqli_query($con, "SET NAMES 'UTF8'");
if (mysqli_connect_error()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
	// echo 'Conexión a la base de datos con éxito!';
}
?>