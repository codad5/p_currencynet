<footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; 2022-<?php echo date('Y'); ?> Ridox studio, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a> <?php if(isset($_SESSION['account_holder'])){
        echo "<a href='inc/logout.inc.php'>logout</a>";
        // echo 'me';
        
      }?></p>
  </footer>