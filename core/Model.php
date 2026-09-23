<?php

class Model
{
    protected $connection;

    public function __construct()
    {
        require_once __DIR__ . "/../config/database.php";

        $database = new Database();

        $this->connection = $database->connect();
    }
}