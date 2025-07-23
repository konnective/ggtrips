<?php
class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $config = require_once __DIR__ . '/../config/database.php';
        
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
            $this->connection = new PDO($dsn, $config['username'], $config['password'], $config['options']);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->connection->prepare($sql);
        
        return $stmt->execute($data);
    }
    
    public function select($table, $conditions = [], $columns = '*') {
        $sql = "SELECT {$columns} FROM {$table}";
        
        if (!empty($conditions)) {
            $whereClause = implode(' AND ', array_map(fn($key) => "{$key} = :{$key}", array_keys($conditions)));
            $sql .= " WHERE {$whereClause}";
        }
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($conditions);
        
        return $stmt->fetchAll();
    }
}