<?php

  include_once('db_connect.php');
  include_once 'InputValidation.php';
  
  
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $errors = array();

  // Registering users
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // retrieving input values from the form
      // all name are stored in lower case
      // all spaces (including tabs and line ends) are removed from names and email.
      $email = mysqli_real_escape_string($db, preg_replace('/\s+/', '', $_SESSION['s_email']));
      $forgetpassword_hash = mysqli_real_escape_string($db, $_SESSION['s_forgetpassword_hash']);
      $password1 = mysqli_real_escape_string($db, $_POST['password1']);
      $password2 = mysqli_real_escape_string($db, $_POST['password2']);
      
      $passwordVal = InputValidation::password($password1, $password2);
      if($passwordVal[0]===FALSE){
          array_push($errors, $passwordVal[1]);
          $_SESSION['s_pwErrors'] = $errors;
      }
      
      //If no error, udpate password and reset forget password hash
      if (count($errors) == 0) {
          $passwordHash = md5($password1);
          $updatePassword = $db->query("UPDATE Users SET password = '$passwordHash' WHERE Email='$email' AND Forgetpassword_Hash='$forgetpassword_hash'") or die(mysql_error());
          $update_forgetPWHash = $db->query("UPDATE Users SET Forgetpassword_Hash = '' WHERE Email='$email' AND Forgetpassword_Hash='$forgetpassword_hash'") or die(mysql_error());
          if($updatePassword AND $update_forgetPWHash){
            if(isset($_SESSION['s_forgetpassword_hash'])){
                unset($_SESSION['s_forgetpassword_hash']);
            }
            if(isset($_SESSION['s_email'])){
                unset($_SESSION['s_email']);
            }
            
            header("Location: ./resetpassword_success_landing.php");
          }
      }
  }

?>
