<?php 
    // echo 'me';

    if (isset($_POST['post_login_submit'])) {
        # code...
        $mail = filter_var($_POST['post_mail'], FILTER_SANITIZE_EMAIL);
        $pwd = $_POST['post_pass']; 
        include "../classes/Dbh.classes.php";
        include "../classes/signup.class.php";
        $signup = new Signup($mail, $pwd);
        // header("location: ../index.php?error=none");
        exit();
    }
    else if(isset($_POST['mail_index'])){
        $mail = $_POST['mail_index'];
        include "../classes/Dbh.classes.php";
        $Checker = new Dbh();
        // echo '';

        if($Checker->checkUser(trim($mail)) === true){
            
            echo ' <script>
                
                
                formInput.action = "inc/signup.inc.php";
                formSubmit.value = "Signup";
                formSubmit.innerHTML = "Signup";
                </script>';
        }
        else{
            echo '<script>
            
            
            formInput.action = "inc/login.inc.php";
            formSubmit.value = "Login";
            formSubmit.innerHTML = "login";
            </script>';
        }


    }