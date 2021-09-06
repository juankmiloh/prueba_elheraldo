<?php
require_once './../util/classConnection.php';

class Votar {
    private $userTbl    = 'voto';
    
    function __construct(){
        // echo "Se instancia la clase votar!";
        if(!isset($this->db)){
            // Conectar a la BD
            $con = new ConnectionBD();
            $this->db = $con->getConnection();
        }
    }
    
    // function checkUser($userData = array()){
    function guardarVoto($votoData = array()){
        if(!empty($votoData)){
            // $query = "insert into voto (idfoto, id_usuario_voto) values ('4', '105338585221132')";
            $query = "INSERT INTO ".$this->userTbl." SET idfoto = '".$votoData['idfoto']."', id_usuario_voto = '".$votoData['id_usuario_voto']."'";
            $insert = $this->db->query($query);
        }
        return;
    }
}
?>