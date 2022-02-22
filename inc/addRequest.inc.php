<?php
session_start();
    if(!isset($_SESSION['account_holder'])){
        header('Location: '.$_SERVER['HTTP_HOST']);
    }
     include "../classes/Dbh.classes.php";
    include "../classes/user.class.php";
    $user = new User($_SESSION['account_holder']);
    
    
    if(isset($_POST['website']) && isset($_POST['website'])){
        echo "<script>
                    notificationAdd('Processing Payment with Paystack ', 'alert-info');
                </script>";
        
        $url = filter_var($_POST['website'], FILTER_SANITIZE_URL);
        $amount = intval($_POST['amount']);
        if($amount >= 1000){
            $prePayment = $user->prePayment($amount, $url);
if($prePayment !== false){

    echo '
            <script>
             $(document).ready(function () {
                 function payWithPaystack() {

                    console.log("hello payWithPaystack");
                // e.preventDefault();
                let handler = PaystackPop.setup({
                    key: "pk_live_4125c5662d4f3ce1a758fc0233bb746bd0dea5a3", // Replace with your public key
                    email: "'.$user->mail.'",
                    amount: '.$amount.' * '.$user->rate.' * 100,
                    currency: "NGN",
                    ref: "'.$prePayment['data']['reference'].'",
                    
                    onClose: function(){
                    alert("Window closed.");
                    },
                    
                    callback: function(response) {
                        let message = "Payment complete! Reference: " + response.reference +"Keep the refrence for safe purpose";
                        alert(message);

                         $(".myPropTable").load("inc/addRequest.inc.php", {
                            refrence: response.reference
                            
                            

                        });
                        
                    }
                });
                handler.openIframe();
            }
            payWithPaystack();
            
        });

            </script>'
            ;
}
            
    }
    else{
            
           echo "<script>
                    notificationAdd('invalid order amount ', 'alert-warning');
                </script>";
        }
    
        
        # code...
    }
    elseif (isset($_POST['refrence'])) {
        $refrence = filter_var($_POST['refrence'], FILTER_SANITIZE_STRING);
        if(empty($_POST['refrence']) || $refrence == null || $refrence == '') {
            echo "<script>
                    notificationAdd('Invalid Input ', 'alert-warning');
                </script>";
            
                            // exit;
        }
        echo "<script>
                    notificationAdd('Verifying Payment for refrence id :".$refrence."' , 'alert-info');
                </script>";
        
        if($user->verifyPayment($refrence)){
            echo "<script>
                    notificationAdd('successfully added for refrence id :".$refrence."' , 'alert-success');
                </script>";
                
            }
        }
        elseif(isset($_POST['ref_key'])){
        $refrence = filter_var($_POST['ref_key'], FILTER_SANITIZE_STRING);
        if(empty($refrence) || $refrence == null || $refrence == '') {
             echo "<script>
                    notificationAdd('Invalid Input :".$refrence."' , 'alert-warning');
                </script>";
            
                            include_once 'table.inc.php';

                            exit;
        }

            if($user->verifyPayment($refrence) === true){
                echo "<script>
                    notificationAdd('successfully added for refrence id :".$refrence."' , 'alert-success');
                </script>";
            }
            elseif($user->verifyPayment($refrence)){
                
            }
            else{
                echo "<script>
                    notificationAdd('Could not verify Payment  with id :".$refrence."' , 'alert-danger');
                </script>";
                

            }
        }


    include_once 'table.inc.php';
?>