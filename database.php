<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1);

class Database {

    public $connection;
    public function __construct()
    {
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        
        $link = 'mysql:host=localhost;dbname=auction;charset=utf8';
        $this->connection = new PDO($link, 'root', 'root', $opt);
    }

}