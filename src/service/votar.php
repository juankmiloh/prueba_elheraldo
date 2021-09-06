<?php
require_once './../util/classConnection.php';

class Votar {
    private $userTbl    = 'voto';
    
    function __construct(){
        echo "votar!";
        if(!isset($this->db)){
            // Conectar a la BD
            $con = new ConnectionBD();
            $this->db = $con->getConnection();
        }
    }
    
    // function checkUser($userData = array()){
    function checkUser(){
        // if(!empty($userData)){
        //     // Revisar si la información de usuario ya existe
        //     $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
        //     $prevResult = $this->db->query($prevQuery);
        //     if($prevResult->num_rows > 0){
        //         // actualizar información si es que existe
        //         $query = "UPDATE ".$this->userTbl." SET first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', modified = '".date("Y-m-d H:i:s")."' WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
        //         $update = $this->db->query($query);
        //     }else{
        //         // Insertar información del usuario
        //         $query = "INSERT INTO ".$this->userTbl." SET ip = '".$_SERVER['SERVER_ADDR']."', oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', created = '".date("Y-m-d H:i:s")."', modified = '".date("Y-m-d H:i:s")."'";
        //         $insert = $this->db->query($query);
        //     }
            
        //     // Tomar la información de la BD
        //     $result = $this->db->query($prevQuery);
        //     $userData = $result->fetch_assoc();
        // }
        
        // return
        return "Funciona!";
    }
}
?>