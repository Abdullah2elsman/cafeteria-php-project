<?php

require_once __DIR__ . '/../config/config.php';

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private static $instance = null;
    private $dbh;
    private $stmt;

    private function __construct()
    {
        $dns = "mysql:host={$this->host};dbname={$this->dbname}";

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->dbh = new PDO($dns, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values to the query (Security against SQL Injection)
    public function bind($param, $value, $type = null) 
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value): 
                    $type = PDO::PARAM_INT; 
                    break;
                case is_bool($value): 
                    $type = PDO::PARAM_BOOL; 
                    break;
                case is_null($value): 
                    $type = PDO::PARAM_NULL; 
                    break;
                default: 
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the query
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Execute the query and return multiple rows
    public function resultSet() 
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Execute and return just one row
    public function single() 
    {
        $this->execute();
        return $this->stmt->fetch();
    }

    // Get row count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    // Get last insert ID
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}
