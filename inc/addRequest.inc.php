<?php
session_start();
    if(!isset($_SESSION['account_holder'])){
        header('Location: '.$_SERVER['HTTP_HOST']);
    }
     include "../classes/Dbh.classes.php";
    include "../classes/user.class.php";
    $user = new User($_SESSION['account_holder']);
    
    
    if(isset($_POST['website']) && isset($_POST['website'])){
        echo '<div class="animate__animated alert alert-info alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                Processing Payment with Paystack<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        $url = filter_var($_POST['website'], FILTER_SANITIZE_URL);
        $amount = intval($_POST['amount']);
        if($amount >= 100){
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
            
            echo '<div class="animate__animated alert alert-warning alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                invalid order amount <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        }
    
        
        # code...
    }
    elseif (isset($_POST['refrence'])) {
        $refrence = filter_var($_POST['refrence'], FILTER_SANITIZE_STRING);
        if(empty($_POST['refrence']) || $refrence == null || $refrence == '') {
            echo '<div class="animate__animated alert alert-success alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                Invalid Input<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            // exit;
        }
        
        echo '<div class="animate__animated alert alert-success alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                Verifying Payment for refrence id :"'.$refrence.'"<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        if($user->verifyPayment($refrence)){
                echo '<div class="animate__animated alert alert-success alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                successfully added for refrence id"'.$refrence.'" <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
            }
        }
        elseif(isset($_POST['ref_key'])){
        $refrence = filter_var($_POST['ref_key'], FILTER_SANITIZE_STRING);
        if(empty($refrence) || $refrence == null || $refrence == '') {
            echo '<div class="animate__animated alert alert-success alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                Invalid Input<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            include_once 'table.inc.php';

                            exit;
        }

            if($user->verifyPayment($refrence) === true){
                echo '<div class="animate__animated alert alert-success alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                successfully added for refrence id"'.$refrence.'" <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
            }
            elseif($user->verifyPayment($refrence)){
                
            }
            else{
                echo '<div class="animate__animated alert alert-danger alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                Could not verify Payment  with id "'.$refrence.'" <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';

            }
        }


    include_once 'table.inc.php';
?>