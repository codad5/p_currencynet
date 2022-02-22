<?php
if(isset($_POST['website'])){
    include "../classes/Dbh.classes.php";
    include "../classes/user.class.php";
    session_start();
    $user = new User($_SESSION['account_holder']);

    
    $url = filter_var($_POST['website'], FILTER_SANITIZE_URL);
    if(empty($url) || $url == false){
        echo "<script>
                        notificationAdd('Invalid Url ', 'alert-danger');
                     </script>";
        include_once 'table.inc.php';

        exit();
    }
    $url = explode("/", $url);
    $sub = '';
    // var_dump($url);
    // echo $url[0];
    for($i = 0; $i < 3; $i++){
        // echo $url[$i];
        $acceptedProtocol = array('http:', 'https:');
        if(!in_array($url[0], $acceptedProtocol)){
            echo "<script>
                        notificationAdd('Invalid Url ', 'alert-danger');
                     </script>";
            
            include_once 'table.inc.php';

            exit();
            // break;

        }
       
        if($i > 1){
        $sub = $sub.$url[$i];
            break;
        }
        else{
            $sub = $sub . $url[$i]."/";
        // echo $sub;
        }
    }
    // echo $sub;
    $url = $sub;
    $code = filter_var($_POST['code'], FILTER_SANITIZE_STRING);
    $currency = filter_var($_POST['default_currency'], FILTER_SANITIZE_STRING) ?? "usd";
    // $html = file_get_contents('http://localhost/Api-test/index.html');
    
    if (filter_var($_POST['website'], FILTER_SANITIZE_URL) != false) {

        // try{
            $tags = @get_meta_tags($url);

        // }catch(Exception $e){
            // Echo "Message:".$e->getMessage();
            // exit();
        // }
        if (isset($tags['currencynet'])) {
            // echo $tags['currencynet'];
            if ($tags['currencynet'] == $code) {

                // $_SESSION['new-website'] = $url;
                $done = $user->addWebsite($url, $currency);
                switch ($done) {
                    case 1:
                        # code...
                        // echo 'Already Registerd'.$done;
                        echo "<script>
                        notificationAdd('Successfully added ', 'alert-success');
                     </script>";
                        
                        break;
                        case 11:
                            echo "<script>
                                    notificationAdd('Website already registered ', 'alert-info');
                                </script>";
                            # code...
                            
                            break;
                            
                            default:
                            echo "<script>
                                    notificationAdd('error ', 'alert-warning');
                                </script>";
                            
                            # code...
                        break;
                }
                
                
            } else {
                $_SESSION['new-website'] = null;
                echo "<script>
                                    notificationAdd('Fail to verify match the content value properly ', 'alert-danger');
                                </script>";
                
            }
        } else {
            echo "<script>
                    notificationAdd('Fail to verify host @ ".$url." ', 'alert-danger');
                </script>";
            
        }
    }
        
    include_once 'table.inc.php';

}
elseif(isset($_POST['website_url'])){
    include "../classes/Dbh.classes.php";
    include "../classes/user.class.php";
    session_start();
    
    $url = filter_var($_POST['website_url'], FILTER_SANITIZE_URL);
    if(empty($url) || $url == false){
        echo "<script>
                    notificationAdd('An error occured while processing ', 'alert-warning');
                </script>";
        
        exit();
    }
    $user = new User($_SESSION['account_holder']);
    if($user->trashWebsite($url)){
        echo "<script>
                    notificationAdd('Successfully deleted ', 'alert-warning');
                </script>";
        
        include_once 'table.inc.php';
    }
    else{
        echo "<script>
                    notificationAdd('Fail to delete ', 'alert-warning');
                </script>";
        
        include_once 'table.inc.php';
    }

}
// if(isset($_POST['']))