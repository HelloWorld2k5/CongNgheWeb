<?php

class Database {
    private $serverName = '127.0.0.1';
    private $dbName = 'FLowerManagement';
    private $userName = 'root';
    private $password = '';
    private $charset = 'utf8mb4';

    public $conn = null;

    public function __construct() {
        $dsn = "mysql:host={$this->serverName};dbname={$this->dbName};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {
            $this->conn = new PDO($dsn, $this->userName, $this->password, $options);
            echo 'Kết nối thành công<br>';
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage(), (int)$ex->getCode());
        }
    }
}

?>