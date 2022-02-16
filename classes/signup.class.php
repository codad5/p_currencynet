<?php
Class Signup extends Dbh {
    private $mail;
    private $pwd;
    public function __construct($mail, $pwd){
        $this->mail = $mail;
        $this->pwd = $pwd;
        $this->emptyInput();
        $this->invalidEmail();
        var_dump( $this->checkUser($this->mail));
        if ($this->checkUser($this->mail) === true){
            echo "hello";
            $this->signUp();
        }
        else{
            header('location:../?error=uidtaken');
        }
    }
    protected function emptyInput(){
        if(empty($this->mail) || empty($this->pwd)){
            header('location:../?error=emptyInput');
        }
    }
    private function invalidEmail(){
        // $result;
        if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL)){
            header('location:../?error=wrongMail');
            exit();

        }

        
        
    } 
    private function signUp(){
        
       $stmt = $this->connect()->prepare('INSERT INTO account_holder (email, pwd) VALUES (?, ?);');
        $hashedPwd = password_hash($this->pwd, PASSWORD_DEFAULT);
        if(!$stmt->execute(array($this->mail, $hashedPwd))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();

        }
        
        header('location:../?error=none');
    }
}