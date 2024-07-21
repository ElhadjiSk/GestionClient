<?php
class Database {
    private $connection;

    public function __construct() {
        $env = parse_ini_file(__DIR__ . '/../.env');
        $this->connection = new mysqli(
            $env['DB_HOST'],
            $env['DB_USER'],
            $env['DB_PASS'],
            $env['DB_NAME']
        );

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
