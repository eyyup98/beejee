<?php

class Database
{

    /**
     * @var PDO
     */
    private PDO $pdo;

    public function __construct()
    {
        $servername = "localhost";
        $database = "beejee";
        $username = "root";
        $password = "root";

        try {
            $this->pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $pe) {
            die("Could not connect to the database  $database :" . $pe->getMessage());
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

}