<?php

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "pos_grosir_baju";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        } catch (Exception $e) {
            echo "Error: " .  $e->getMessage();
        }
    }

    public function query($query)
    {
        return $this->conn->query($query);
    }
}
