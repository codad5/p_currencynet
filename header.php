<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/animations.css">
    <link rel="stylesheet" href="style/animate.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/dist/carousel.css">
    <link rel="stylesheet" href="bootstrap/dist/carousel.rtl.css">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="http://localhost/currencynet/scripts/production/production.js"></script>
    <script src="https://kit.fontawesome.com/598c5133cc.js" crossorigin="anonymous"></script>

    <script src="scripts/jquery-3.6.0.min.js"></script>
</head>

<body>
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
<div class="notifications-box-cnt">
      <div class="alert alert-info alert-dismissible fade show"> HEllo <button type="button" class="btn-close noti-btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    </div>

    <script>
      
      const notificationbox = document.querySelector('.notifications-box-cnt');
      const notification_close_btn = document.querySelectorAll('.noti-btn-close');
      const notificationAdd = (message, noti_type = 'alert-info') => {
        const new_notification = document.createElement("div");
        const notification_close_btn = document.createElement("button");
        new_notification.className = `alert alert-dismissible fade show ${noti_type} animate__animated animate__backInRight`;
        notification_close_btn.className = `btn-close noti-btn-close`;
        notification_close_btn.dataset.bsDismiss = `alert`;
        let node = document.createTextNode(message);
        new_notification.appendChild(node);
        
        new_notification.appendChild(node);
        new_notification.appendChild(notification_close_btn);

        
        notificationbox.appendChild(new_notification);
        setTimeout(() => {

                new_notification.classList.remove('animate__backInRight');
                new_notification.classList.add('animate__backOutRight');
                
                
            
        }, 3000);
        setTimeout(() => {

                
                new_notification.remove();
                
            
        }, 3800);
      }
    //   Array.prototype.forEach.call(notification_close_btn, elem => {
    //     setTimeout(() => {
    //       elem.click();
    //       console.log('hello');
    //     }, 2000)
    //   });
    </script>