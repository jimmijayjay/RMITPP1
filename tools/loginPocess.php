<?php

  session_start();
  include_once('db_connect.php');

  $email = $entered_password = "";
  $email_err = $error_message = $password_err = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["email"]))) {
      $email_err = "Please enter email.";
    } else {
      $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
      $password_err = "Please enter your password.";
    } else {
      $entered_password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
      // Prepare a select statement
      $sql = "SELECT UserID, Email, Password, FirstName, LastName, UserTypeID FROM Users WHERE Active = 1 AND Email = ?";

      if ($stmt = mysqli_prepare($db, $sql)) {

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $email);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {

          // Store result
          mysqli_stmt_store_result($stmt);

          // Check if username exists, if yes then verify password
          if (mysqli_stmt_num_rows($stmt) == 1) {

            // Bind result variables
            mysqli_stmt_bind_result($stmt, $userid, $email, $password, $firstname, $lastname, $usertypeid);

            if (mysqli_stmt_fetch($stmt)) {
              if ($password == md5($entered_password)) {
                
                // Store data in session variables
                $_SESSION["userid"] = $userid;
                $_SESSION["email"] = $email;
                $_SESSION["firstname"] = $firstname;
                $_SESSION["lastname"] = $lastname;
                
                if ($usertypeid == 1) {
                  $_SESSION["admin_loggedin"] = true;
                  header("location: admin/index.php");
                } else {
                  $_SESSION["loggedin"] = true;
                  // Redirect user to welcome page
                  header("location: index.php");
                }

              } else {
                // Display an error message if password is not valid
                $password_err = "The password you entered was not valid.";
              }
            }
          } else {
            // Display an error message if email doesn't exist
            $email_err = "No account found with that email.";
          }

        } else {
          $error_message = "Oops! Something went wrong. Please try again later.";
        }
      }

      // Free result
      mysqli_stmt_free_result($stmt);

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }