<?php
Class Login extends Dbh {
    private $mail;
    private $pwd;
    public function __construct($mail, $pwd){
        $this->mail = $mail;
        $this->pwd = $pwd;
        $this->emptyInput();
        $this->invalidEmail();
        // var_dump( $this->checkUser($this->mail));
        
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
    public function login(){
        if($this->checkUser($this->mail)){
            $details = $this->checkUser($this->mail);
            $checkPwd = password_verify($this->pwd, $details[0]['pwd']);
            if ($checkPwd == false) {
                # code...
                
                header("location: ../?error=wrongpassword");
                // return false;
                exit();
            }
            else{
                return $this->checkUser($this->mail);
                


            }
        }
        else{
            return false;
        }
        
    
    }
}