<?php

  include_once 'InputValidation.php';
  include_once('db_connect.php');
  include_once 'sendemail.php';
  $firstName = "";
  $email = "";
  $errors = InputValidation::$errors;    
  // Registering users

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // retrieving input values from the form
      // all emails are stored in lower case
      // all spaces (including tabs and line ends) are removed email.
      $email = mysqli_real_escape_string($db, preg_replace('/\s+/', '', $_POST['email']));
      
      //Checking whehter the email address has been registered
      $email_check_query = "SELECT userid, firstName FROM Users WHERE email = '$email' LIMIT 1";       
      $result = mysqli_query($db, $email_check_query);        
      $row = mysqli_fetch_assoc($result);     
      if (!$row) {
          array_push($errors, "Email not registered");
      }
      
      //If no error, sender verification link to let user reset password
      if (count($errors) == 0) {
            $forgetpassword_hash = md5 (rand(0,1000)); // Generate a random 32 character hash

            
            $firstName = $row['firstName'];
            print "first name ";
            print $firstName;
          
          
            $subject = "Car Buddy - Reset Your Password";
            $emailMessage = '

            Hi '.$firstName.',
                
            Your have requested resetting the password. 

            Please click on the below link to reset password of your Car Buddy account:
            http://www.carbuddy.ga/resetpassword.php?email='.$email.'&hash='.$forgetpassword_hash.'

            Kind Regards,
            Car Buddy Team
            ';
            sendEmail($subject, $emailMessage, $email);
            //header("Location: ./forgetpassword_success_landing.php");
          
      }
  }








?>
