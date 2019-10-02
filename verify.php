<?php include_once('tools/head.php'); ?>
  <body>
    <?php include_once('tools/nav.php'); 
      
          include_once('includes/db_connect.php');?>


          <section class="probootstrap-cover">
          <div class="container">
            <div class="row probootstrap-vh-100 align-items-center text-center">
              <div class="col-sm">
                <div class="probootstrap-text">
                  <h1 class="probootstrap-heading text-white mb-4">
                  <?php
            /* Verify email and hash received*/
            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                $email = mysqli_real_escape_string($db, $_GET['email']);
                $hash = mysqli_real_escape_string($db, $_GET['hash']);
                $search = $db->query("SELECT Email, Hash, Active FROM Users WHERE Email='$email' AND Hash='$hash' AND Active = 0") or die(mysql_error());
                $match  = mysqli_num_rows($search);
                if($match>0){
                    // Email and hash matches found, activate the account
                    $update = $db->query("UPDATE Users SET Active = 1 WHERE Email='$email' AND Hash='$hash' AND Active = 0") or die(mysql_error());
                    echo '<div>Your account has been activated, you can now login</div>';
                    echo '<p><a href="login.php" class="btn btn-primary mr-2 mb-2">login</a></p>';
                }else{
                    echo '<div>The url is either invalid or you already have activated your account.</div>';
                }
            }else{
                    echo '<div>Invalid link, please use the link that has been send to your email.</div>';
            }

            /* close connection */
            mysqli_close($db);

        ?></h1>
                  <div class="probootstrap-subheading mb-5">
                    <p class="h4 font-weight-normal">
                    
                    </p>
                  </div>
                  <!--<p><a href="registration.php" class="btn btn-primary mr-2 mb-2">Try It Now</a><a href="services.php" class="btn btn-primary btn-outline-white mb-2">See Range</a></p> -->
                </div>
              </div>
            </div>
          </div>
        </section>

    <?php include_once('tools/footer.php'); ?>  

</body>
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>