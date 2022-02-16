<?php
if(isset($_POST['website'])){
    include "../classes/Dbh.classes.php";
    include "../classes/user.class.php";
    session_start();
    $user = new User($_SESSION['account_holder']);

    
    $url = filter_var($_POST['website'], FILTER_SANITIZE_URL);
    if(empty($url) || $url == false){
        echo '<div class="animate__animated alert alert-danger  alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                invalid Url <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
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
            
            echo '<div class="animate__animated alert alert-danger  alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                invalid Url <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
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
                        echo '<div class="animate__animated alert alert-success alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                success <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        break;
                        case 11:
                            # code...
                            echo '<div class="animate__animated alert alert-info alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                Website already registered <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            break;
                            
                            default:
                            echo '<div class="animate__animated alert alert-warn alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                error <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            # code...
                        break;
                }
                
                
            } else {
                $_SESSION['new-website'] = null;
                echo '<div class="animate__animated alert alert-danger alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                Fail to verify match the content value properly<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
            }
        } else {
            echo '<div class="animate__animated alert alert-danger alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                Fail to verify host @ '.$url.'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
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
        echo '<div class="animate__animated alert alert-warning alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                An error occured while processing <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        exit();
    }
    $user = new User($_SESSION['account_holder']);
    if($user->trashWebsite($url)){
        echo '<div class="animate__animated alert alert-warning alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                                Successfully deleted <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        include_once 'table.inc.php';
    }
    else{
        echo '<div class="animate__animated alert alert-warning alert-dismissible fade show notification-tab animate__backInRight" role="alert">
                               fail to delete <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        include_once 'table.inc.php';
    }

}
// if(isset($_POST['']))