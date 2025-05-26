<?php
require_once 'config_db.php';

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $config = include 'config_db.php';
        $this->pdo = new PDO(
            $config['dsn'],
            $config['user'],
            $config['pass'],
            $config['options']
        );
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }
}
