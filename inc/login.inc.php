<?php 
// session_start();
    if (isset($_POST['post_login_submit'])) {
        # code...
        $mail = filter_var($_POST['post_mail'], FILTER_SANITIZE_EMAIL);
        $pwd = $_POST['post_pass']; 
        include "../classes/Dbh.classes.php";
        include "../classes/login.class.php";
        $login = new Login($mail, $pwd);
        if (!$login->login()){
            echo "hello";
            header('location:../?error=wronglogin');
            
            
                
            
            
        }
        else{
            session_start();
                $details = $login->login();
                $_SESSION['account_holder'] = $details[0]['email'];
                $_SESSION['account_id'] = $details[0]['account_id'];
                echo $_SESSION['account_holder'];
                // $_SESSION['Email'] = $details[0]['usersEmail'];
                header("location: ../");
                // exit();
            }
            // header("location: ../index.php?error=none");
            // exit();
        }
        else{
        header("location: ../");

    }