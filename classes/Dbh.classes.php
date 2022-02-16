<?php

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

        public function checkUser($email){
        $stmt = $this->connect()->prepare("SELECT * FROM account_holder WHERE email = ?;");
        if(!$stmt->execute(array($email))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();

        }
        // return $stmt->rowCount();
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
        else{
            return  true; 
            #$stmt->rowCount();
        }
       

    }
    
    protected function checkWebsite($domain){
        $stmt = $this->connect()->prepare("SELECT * FROM websites WHERE website_domain  = ?;");
        if(!$stmt->execute(array($domain))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();

        }
        // return $stmt->rowCount();
        if($stmt->rowCount() < 1){
            // echo $stmt->rowCount();
            return  false; #$stmt->rowCount();
            
        }
        else{
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            // return false;
        }
       

    }
    protected function getPayment($refrence){
        $stmt = $this->connect()->prepare("SELECT * FROM request_orders WHERE refrence_key  = ?;");
        if(!$stmt->execute(array($refrence))){
            $stmt = null;
            return false;

        }
        // return $stmt->rowCount();
        if($stmt->rowCount() < 1){
            // echo $stmt->rowCount();
            return  false; #$stmt->rowCount();
            
        }
        else{
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            // return false;
        }
       

    }
    
    
    }