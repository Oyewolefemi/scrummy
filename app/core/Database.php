<?php

class Database {
    private static $instance = null;
    private $conn;
    private $stmt;

    // Private constructor prevents direct object creation
    private function __construct() {
        // Get credentials from the loaded Env
        $host = getenv('DB_HOST');
        $name = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        $dsn = "mysql:host={$host};dbname={$name};charset=utf8mb4";

        try {
            $this->conn = new PDO($dsn, $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }
    }

    // The Singleton Accessor
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Helper: Prepare Query
    public function query($sql) {
        $this->stmt = $this->conn->prepare($sql);
        return $this; // Allow chaining
    }

    // Helper: Bind Values
    public function bind($param, $value, $type = null) {
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
        return $this;
    }

    // Helper: Execute
    public function execute() {
        return $this->stmt->execute();
    }

    // Helper: Fetch All Records
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Helper: Fetch Single Record
    public function single() {
        $this->execute();
        return $this->stmt->fetch();
    }
    
    // Helper: Get Row Count
    public function rowCount() {
        return $this->stmt->rowCount();
    }
    
    // Helper: Last Insert ID
    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }
}