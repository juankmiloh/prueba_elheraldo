<?php
    header("access-control-allow-origin: *");
    ob_start(); //Linea para permitir enviar flujo de datos por url al redireccionar la pagina 

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
    }

?>