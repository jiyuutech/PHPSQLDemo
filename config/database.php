<?php

class Database {
    protected $connection = null;

    public function __construct() {
        try{
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage();
        }
    }

    public function getConnection(){
        return $this->connection;
    }
}