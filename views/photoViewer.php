<?php
    session_start();
    $logoutURL = '../_oauth/cerrar.php';
    $userData = $_SESSION['userData'];
    print("Datos usuario --> ".json_encode($userData));
?>

<?
    echo $userData['first_name'];
?>