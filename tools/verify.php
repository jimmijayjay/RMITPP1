<?php include_once('tools/head.php'); ?>
  <body>
    <?php include_once('tools/nav.php');

          include_once('includes/db_connect.php');




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
                }else{
                    echo '<div>The url is either invalid or you already have activated your account.</div>';
                }
            }else{
                    echo '<div>Invalid link, please use the link that has been send to your email.</div>';
            }

            /* close connection */
            mysqli_close($db);

        ?>
    <?php include_once('includes/footer.php'); ?>
