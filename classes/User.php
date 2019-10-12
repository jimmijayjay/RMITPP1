<?php

class User
{

  // Set private variables
  private $_db,
          $_sendMail,
          $UserID,
          $FirstName,
          $LastName,
          $Email,
          $UserTypeID,
          $_sessionName;

  // Default constructor
  public function __construct($user = null)
  {
    $this->_db = DB::getInstance();
    $this->_sendMail = Email::getInstance();

    $this->_sessionName = Config::get('sessions/session_name');

    /*if(!$user) {
      if (Session::exists($this->_sessionName)) {
        $user = Session::get($this->_sessionName);

        if ($this->find($user)) {
          $this->isLoggedIn = true;
        } else {
          //Logout
        }
      }
    } else {
      $this->findByID($user);
    }*/
  }

  // Setup user
  private function setup($userid, $firstname, $lastname, $email, $userTypeID)
  {
    $this->UserID = $userid;
    $this->FirstName = $firstname;
    $this->LastName = $lastname;
    $this->Email = $email;
    $this->UserTypeID = $userTypeID;

    Session::put($this->_sessionName, $this);
  }

  // Getters
  public function getUserID()
  {
    return $this->UserID;
  }

  public function getFirstName()
  {
    return $this->FirstName;
  }

  public function getLastName()
  {
    return $this->LastName;
  }

  public function getEmail()
  {
    return $this->Email;
  }

  public function getUserTypeID()
  {
    return $this->UserTypeID;
  }

  // Check user logged in status
  public function isLoggedIn()
  {
    if (is_null($this->UserID) || !is_numeric($this->UserID)) {
      return false;
    }
    return true;
  }

  // Login method
  public function login($email = null, $password = null)
  {
    $return = false;
    $passwordHash = md5($password);

    $mysqli = $this->_db->_conn;

    if ($result = $mysqli->query("SELECT UserID, FirstName, LastName, Email, UserTypeID FROM Users WHERE Active = 1 AND Email = '$email' AND Password = '$passwordHash'")) {
      if ($result->num_rows == 1) {
        $thisUser = $result->fetch_array();

        $this->setup($thisUser[0], $thisUser[1], $thisUser[2], $thisUser[3], $thisUser[4]);
      }

      $result->close();

      $return = true;
    } else {
      echo $result->error;
    }

    return $return;
  }

  // Register method
  public function register($firstname = null, $lastname = null, $email = null, $password = null)
  {
    $return = false;
    $hash = md5(rand(0,1000));
    $passwordHash = md5($password);

    $mysqli = $this->_db->_conn;

    // Check if this email already exist
    $result = $mysqli->query("SELECT UserID FROM Users WHERE Email = '$email'");

    if ($result->num_rows == 0) {
      if ($insertResult = $mysqli->query("INSERT INTO Users (FirstName, LastName, Email, Password, Hash, UserTypeID) VALUES ('$firstname', '$lastname', '$email', '$passwordHash', '$hash', 2)")) {

          $subject = "Welcome to Car Buddy! Confirm your email";
          $emailMessage = '

          Hi '.$firstname.',

          Please click on the below link to activate your Car Buddy account:
          http://www.carbuddy.ga/verify.php?email='.$email.'&hash='.$hash.'

          Kind Regards,
          Car Buddy Team
          ';

          $this->_sendMail->sendEmail($subject, $emailMessage, $email);

          $return = true;
      } else {
        echo $insertResult->error;
      }

      $result->close();
    }

    return $return;
  }

  // Forget password method
  public function forgetPassword($email = null)
  {
    $return = false;
    $hash = md5(rand(0,1000));
    $passwordHash = md5($password);

    $mysqli = $this->_db->_conn;

    // Get other details for this user

    if ($result = $mysqli->query("SELECT UserID, FirstName FROM Users WHERE Active = 1 AND Email = '$email'")) {
      if ($result->num_rows == 1) {
        $hash = md5(rand(0,1000));

        $thisUser = $result->fetch_array();
        $userid = $thisUser[0];
        $firstName = $thisUser[1];

        if ($update = $mysqli->query("UPDATE Users SET ForgetPasswordHash = '$hash' WHERE UserID = $userid")) {
          $subject = "Car Buddy - Reset Your Password";
          $emailMessage = '

          Hi '.$firstName.',

          You have requested resetting your password.

          Please click on the below link to reset password of your Car Buddy account:
          http://www.carbuddy.ga/resetpassword.php?email='.$email.'&forgetpassword_hash='.$hash.'

          Kind Regards,
          Car Buddy Team
          ';

          $this->_sendMail->sendEmail($subject, $emailMessage, $email);

          $return = true;
        } else {
          echo $update->error;
        }

        $result->close();
      }
    }

    return $return;
  }

  // Reset Password method
  public function resetPassword($email = null, $hash = null, $password = null)
  {
    $return = false;
    $passwordHash = md5($password);

    $mysqli = $this->_db->_conn;

    // Check if this email already exist

    if ($result = $mysqli->query("SELECT UserID FROM Users WHERE Active = 1 AND Email = '$email' AND ForgetPasswordHash = '$hash'")) {
      if ($result->num_rows == 1) {

        $thisUser = $result->fetch_array();
        $userid = $thisUser[0];

        if ($updateResult = $mysqli->query("UPDATE Users SET Password = '$passwordHash', ForgetPasswordHash = '' WHERE UserID = $userid")) {
            $return = true;
        } else {
          echo $updateResult->error;
        }

        $result->close();
      }
    }

    return $return;
  }

  // Verify method
  public function verify($email = null, $hash = null)
  {
    $return = false;
    $mysqli = $this->_db->_conn;

    // Check if this email already exist
    $result = $mysqli->query("SELECT UserID FROM Users WHERE Active = 0 AND Email = '$email' AND Hash = '$hash'");

    if ($result->num_rows == 1) {

      $thisUser = $result->fetch_array();
      $userid = $thisUser[0];

      if ($update = $mysqli->query("UPDATE Users SET Active = 1 WHERE UserID = $userid")) {
          $return = true;
      } else {
        echo $update->error;
      }

      $result->close();
    }

    return $return;
  }

  // Find by ID
  public function findByID($userid = null) {
    if ($userid) {
      if ($result = $this->_db->_conn->query("SELECT UserID, FirstName, LastName, Email FROM Users WHERE UserID = $userid")) {
        return $result->fetch_array();

        $result->close();
      }
    }

    return 0;
  }

  public function logout() {
    //$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));
    Session::delete($this->_sessionName);
    //Cookie::delete($this->_cookieName);
  }

}