
<?php

class Conection{

    private $con;
    private $host;
    private $user;
    private $password;

    private $pdo;

    public function __construct($con,$host,$user,$password){
        $this->$con = $con;
        $this->$host = $host;
        $this->$user = $user;
        $this->$password = $password;
        try{
            $this->pdo = new PDO("mysql:dbname=".$con.";host=".$host,$user,$password);
            echo $con;

        }catch(PDOExeption $e){
            echo $e->getMessage();
            exit;
        }
        catch(Exeption $e){
            echo $e->getMessage();
            exit;
        }
    }
    
    public function get_pdo(){
        return $this->pdo;
    }
    public function get_con(){
        return $this->con;
    }
    public function get_host(){
        return $this->host;
    }
    public function get_user(){
        return $this->user;
    }
    public function get_password(){
        return $this->password;
    }
}



?>