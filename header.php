<?php 
// session_start();
if(!isset($_SESSION['account_holder'])){
    include_once 'inc/nosession.header.php';
    // exit;
}
else{
    include_once 'inc/session.header.php';

}
?>
