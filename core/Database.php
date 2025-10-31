<?php

class Database {

    private $pdo;

    public function __construct() {

      

        $host = 'localhost';

        $db = 'lacuponerasv';

        $user = 'root';

        $pass = '';

        try {

            $this->pdo = new PDO(dsn: "mysql:host=$host;dbname=$db;charset=utf8mb4", username: $user, password: $pass);

            $this->pdo->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);

            $this->pdo->setAttribute(attribute: PDO::ATTR_DEFAULT_FETCH_MODE, value: PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            die('Connection failed: ' . $e->getMessage());

        }

    }

    public function getConnection(): PDO {

        return $this->pdo;

    }

}