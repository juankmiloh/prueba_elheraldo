<?php
class ConnectionBD {
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "root";
    private $dbName     = "n260m_20217865_itic";
    
    function __construct() {
        if(!isset($this->db)){
            // Conectar a la BD
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName, 3307);
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
?>