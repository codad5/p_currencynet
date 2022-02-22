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