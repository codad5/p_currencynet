<?php
session_start();
if(!isset($_POST["url"])){
    header("Location:../ " );
    exit();
}
$url = filter_var($$_POST["url"], FILTER_SANITIZE_URL);
if($url == false){
    header("Location:../?error=invalidurl " );

}