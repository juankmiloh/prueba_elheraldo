<?php
$mysqli = mysqli_init();
if (!$mysqli) {
  die("mysqli_init failed");
}

$mysqli -> ssl_set("client-key.pem", "client-cert.pem", "ca.pem", '', '');

if (!$mysqli -> real_connect("elheraldo.centralus.cloudapp.azure.com","hakase","Hakase-labs123@","elheraldo",3306)) {
  die("Connect Error: " . mysqli_connect_error());
}

// Some queries...

echo "Conectado a la base de datos exitosamente por SSL!";

$mysqli -> close();
?>