<?php

class Db{
    private $hostname;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    public function connect(){
        $host=$this->hostname='localhost';
        $db=$this->dbname='restfull';
        $us=$this->username='root';
        $pass=$this->password='';

        try {
            $this->conn=new PDO("mysql:host=$host;dbname=$db", $us, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            return $this->conn;

        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
}



