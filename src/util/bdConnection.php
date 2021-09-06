<?php
class ConnectionBD {
    // private $dbHost     = "localhost"; // Conexion localhost
    // private $dbPort     = 3307; // Conexion localhost
    private $dbHost     = "elheraldo.centralus.cloudapp.azure.com"; // Conexion AZURE
    private $dbPort     = 3306; // Conexion AZURE
    private $dbUsername = "root";
    private $dbPassword = "root";
    private $dbName     = "elheraldo";
    
    function __construct() {
        if(!isset($this->db)){
            // Conectar a la BD
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName, $this->dbPort);
            if($conn->connect_error){
                echo("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                echo("Conexión a la base de datos con éxito!");
                $this->db = $conn;
            }
        }
    }

    function getConnection() {
        return $this->db;
    }
}
// $con = new ConnectionBD();
?>