<?php
header("access-control-allow-origin: *");
require_once './../util/bdConnection.php';

$data = $_POST['data'];

echo json_encode($data);
?>