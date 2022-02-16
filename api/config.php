<?php

    // class Connect extends PDO{
    //     private $host= "localhost";
    //     private $user= "root";
    //     private $pwd= "";
    //     private $dbName= "api";

    //     public function __construct() {
    //         $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
    //         $pdo = new PDO($dsn, $this->user, $this->pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    //         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //         // return $pdo;
    //     }
    // }

     class Dbh{
        private $host= "localhost";
        private $user= "root";
        private $pwd= "";
        private $dbName= "currencynet";

        protected function connect() {
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
            $pdo = new PDO($dsn, $this->user, $this->pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }
    }