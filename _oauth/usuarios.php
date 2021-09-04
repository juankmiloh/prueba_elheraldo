<?php
class User {
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "root";
    private $dbName     = "n260m_20217865_itic";
    private $userTbl    = 'users';
    
    function __construct() {
        // if(!isset($this->db)){
        //     // Conectar a la BD
        //     $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName, 3307);
        //     if($conn->connect_error){
        //         echo("Failed to connect with MySQL: " . $conn->connect_error);
        //         // die("Failed to connect with MySQL: " . $conn->connect_error);
        //     }else{
        //         // echo("Conexión a la base de datos con éxito!");
        //         $this->db = $conn;
        //         // echo $this->db;
        //     }
        // }
    }

    function probarConn(){
        echo('Hola mundo!');
        // return $this->db;
    }    

    function getRealIP(){

        if (isset($_SERVER["HTTP_CLIENT_IP"])){

            return $_SERVER["HTTP_CLIENT_IP"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){

            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){

            return $_SERVER["HTTP_X_FORWARDED"];

        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){

            return $_SERVER["HTTP_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_FORWARDED"])){

            return $_SERVER["HTTP_FORWARDED"];

        }else{

            return $_SERVER["REMOTE_ADDR"];

        }
    }    
    
    function checkUser($userData = array()){
        if(!empty($userData)){
            // Revisar si la información de usuario ya existe
            $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
            $prevResult = $this->db->query($prevQuery);
            if($prevResult->num_rows > 0){
                // actualizar información si es que existe
                $query = "UPDATE ".$this->userTbl." SET first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', modified = '".date("Y-m-d H:i:s")."' WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
                $update = $this->db->query($query);
            }else{
                // Insertar información del usuario
                $query = "INSERT INTO ".$this->userTbl." SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', created = '".date("Y-m-d H:i:s")."', modified = '".date("Y-m-d H:i:s")."'";
                $insert = $this->db->query($query);
            }
            
            // Tomar la información de la BD
            $result = $this->db->query($prevQuery);
            $userData = $result->fetch_assoc();
        }
        // print("Datos usuario --> ".json_encode($userData));
        
        // return
        return $userData;
    }
}
$user = new User();
$userData = $user->getRealIP();
echo $userData;
?>