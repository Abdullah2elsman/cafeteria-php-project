<?php

class Database {

    private $host = "127.0.0.1";
    private $dbname = "php_lab";
    private $username = "root";
    private $password = "123456";

    public $connection;

    public function connect(){

        try{

            $this->connection = new PDO(
                "mysql:host=".$this->host.";dbname=".$this->dbname.";charset=utf8",
                $this->username,
                $this->password
            );

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->connection;

        } catch(PDOException $e){

            die($e->getMessage());

        }

    }

}

?>