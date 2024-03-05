<?php

class DBConnection{
    private $hostname = "Localhost";
    private $username = "root";
    private $password = "";
    private $database = "bilaltransportcompany";

    protected $connection;

    public function __construct(){
        $this->connection = new mysqli($this->hostname,$this->username,$this->password, $this->database);

        if($this->connection->connect_error){
            die("Connecton Field " . $this->connection->connect_error);
        }
    }
}


?>