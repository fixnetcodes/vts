<?php

class DB
{
    //define database properties
    public $hostname  = 'localhost';
    public $username  = 'root';
    public $password  = '';
    public $dbname    = 'vessel_tracking';
    
    public $conn;
    
    public function __construct()
    {
        $this->conn = $this->connect();
    }
    
    public function connect()
    {
        try{
            $this->conn = new PDO("mysql:host=$this->hostname; dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
        }catch(\PDOException $e){
            echo 'Connection failed '. $e->getMessage();
        }
        
        return $this->conn;
        
    }
}
