<?php

namespace app\config;

use PDO;
use PDOException;
use Dotenv\Dotenv;
use app\api\Application;

class Database {
    private static $instance;
    protected $db;

    protected function __construct() {
        $envFilePath = Application::$root . '/.env';

        if (!file_exists($envFilePath)) {
            die('.env file not found');
        }

        try {
            $dotenv = Dotenv::createImmutable(Application::$root);
            $dotenv->load();
        } catch (\Dotenv\Exception\InvalidPathException $e) {
            die('.env file could not be loaded: ' . $e->getMessage());
        }

        $host = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_NAME'];
        $charset = $_ENV['DB_CHARSET'];

        try {
            $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
            $this->db = new PDO($dsn, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
        
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->db;
    }
}
