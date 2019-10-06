<?php 

          include_once('db_connect.php');
          $link_errors = array();
    
           
            /* Verify email and forget password hash received*/
            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['forgetpassword_hash']) && !empty($_GET['forgetpassword_hash'])){
                

                
                $email = mysqli_real_escape_string($db, $_GET['email']);
                $forgetpassword_hash = mysqli_real_escape_string($db, $_GET['forgetpassword_hash']);
                $search = $db->query("SELECT Email, forgetpassword_hash FROM Users WHERE Email='$email' AND forgetpassword_hash='$forgetpassword_hash'") or die(mysql_error());
                $match  = mysqli_num_rows($search);
                if($match>0){
                    // Email and hash matches found, no error
                }else{
                    echo '<div>The url is not valid</div>';
                    array_push($link_errors, "The url is not valid");
                }
            }else{
                    echo '<div>Invalid link</div>';
                    array_push($link_errors, "Invalid link");
            }      
            

            
            /* close connection */
            mysqli_close($db);
          
                           
 ?>

    