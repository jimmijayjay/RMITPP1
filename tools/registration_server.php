<?php

  include_once('db_connect.php');
  include_once('sendemail.php');

  // initializing variables
  $firstName = "";
  $lastName = "";
  $email = "";
  $errors = array();

  // Registering users
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // retrieving input values from the form
      // all name are stored in lower case
      // all spaces (including tabs and line ends) are removed from names and email.
      $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
      $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
      $email = mysqli_real_escape_string($db, preg_replace('/\s+/', '', $_POST['email']));
      $password1 = mysqli_real_escape_string($db, $_POST['password1']);
      $password2 = mysqli_real_escape_string($db, $_POST['password2']);
      
      // Form validation: all input fields are required
      if (empty($firstName)) {
          array_push($errors, "First name not entered");
      }

      if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
          array_push($errors, "Special symbols in names are not allows");
      }

      if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
          array_push($errors, "Special symbols in names are not allows");
      }

      if (empty($lastName)) {
          array_push($errors, "Last name not entered");
      }

      if (empty($email)) {
          array_push($errors, "Email not entered");
      } else {
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              array_push($errors, "Email not valid");
          }
      }

      if ($password1 != $password2) {
          array_push($errors, "The two passwords are not the same");
      }

      if (strlen($password1) > 50) {
          array_push($errors, "Password is too long");
      }

      if (strlen($firstName) > 100 OR strlen($lastName) > 100) {
          array_push($errors, "First name or last name is too long");
      }

      if (strlen($email) > 100) {
          array_push($errors, "Email is too long");
      }

      //Checking whehter the email address has been registered
      $email_check_query = "SELECT userid FROM Users WHERE email = '$email' LIMIT 1";

      $result = mysqli_query($db, $email_check_query);
      $email_exists_check = mysqli_fetch_assoc($result);

      if ($email_exists_check) {
          array_push($errors, "Email already registered");
      }

      //If no error, register users
      if (count($errors) == 0) {
          $hash = md5 (rand(0,1000)); // Generate a random 32 character hash
          $passwordHash = md5($password1); // Hash the password

          $query = $db->query("INSERT INTO Users (FirstName, LastName, Email, Password, Hash, UserTypeID) VALUES('$firstName', '$lastName', '$email', '$passwordHash', '$hash', 2)");

          if($query){
            $subject = "Welcome to Car Buddy! Confirm your email";
            $emailMessage = '

            Hi '.$firstName.',

            Please click on the below link to activate your Car Buddy account:
            http://www.carbuddy.ga/verify.php?email='.$email.'&hash='.$hash.'

            Kind Regards,
            Car Buddy Team
            ';
            sendEmail($subject, $emailMessage, $email);
            header("Location: ./reg_success_landing.php");
          }
      }
  }

?>
