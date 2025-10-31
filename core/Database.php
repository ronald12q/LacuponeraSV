<?php

class Database {

    private $pdo;

    public function __construct() {

      

        $host = 'localhost';

        $db = 'lacuponerasv';

        $user = 'root';

        $pass = '';

        try {

            $this->pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            die('Connection failed: ' . $e->getMessage());

        }

    }

    public function getConnection() {

        return $this->pdo;

    }

}