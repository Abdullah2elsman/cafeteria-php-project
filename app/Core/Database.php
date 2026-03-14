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

    private function __contruct()
    {
        $dns = "mysql:host=$this->host;dbname=$this->dbname";

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->dbh = new PDO($dns, $this->user, $this->pass);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            $instance = new Database();
        }
        return $instance;
    }

    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }
}


// some helper function to future features

// // 4. Helper: Bind values to the query (Security against SQL Injection)
//     public function bind($param, $value, $type = null) {
//         if (is_null($type)) {
//             switch (true) {
//                 case is_int($value): $type = PDO::PARAM_INT; break;
//                 case is_bool($value): $type = PDO::PARAM_BOOL; break;
//                 case is_null($value): $type = PDO::PARAM_NULL; break;
//                 default: $type = PDO::PARAM_STR;
//             }
//         }
//         $this->stmt->bindValue($param, $value, $type);
//     }

//     // 5. Helper: Execute the query and return multiple rows
//     public function resultSet() {
//         $this->stmt->execute();
//         return $this->stmt->fetchAll();
//     }

//     // 6. Helper: Execute and return just one row
//     public function single() {
//         $this->stmt->execute();
//         return $this->stmt->fetch();
//     }
