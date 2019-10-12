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
          $_sessionName;

  // Default constructor
  public function __construct($user = null)
  {
    $this->_db = DB::getInstance();
    //$this->_sendMail = Email::getInstance();

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
  private function setup($userid, $firstname, $lastname, $email)
  {
    $this->UserID = $userid;
    $this->FirstName = $firstname;
    $this->LastName = $lastname;
    $this->Email = $email;

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
    $passwordHash = md5($password);

    if ($result = $this->_db->_conn->query("SELECT UserID, FirstName, LastName, Email FROM Users WHERE Email = '$email' AND Password = '$passwordHash'")) {
      if ($result->num_rows == 1) {
        $thisUser = $result->fetch_array();

        $this->setup($thisUser[0], $thisUser[1], $thisUser[2], $thisUser[3]);
      } else {
        return false;
      }

      $result->close();

      return true;
    }

    return false;
  }

  // Register method
  public function register($firstname = null, $lastname = null, $email = null, $password = null)
  {
    $hash = md5(rand(0,1000));
    $passwordHash = md5($password);

    if ($result = $this->_db->_conn->query("INSERT INTO Users (FirstName, LastName, Email, Password, Hash, UserTypeID) VALUES ('$firstname', '$lastname', '$email', '$passwordHash', '$hash', 2)")) {

      //$result->close();
/*
        $subject = "Welcome to Car Buddy! Confirm your email";
        $emailMessage = '

        Hi '.$firstname.',

        Please click on the below link to activate your Car Buddy account:
        http://www.carbuddy.ga/verify.php?email='.$email.'&hash='.$hash.'

        Kind Regards,
        Car Buddy Team
        ';
*/
        //$this->_sendMail->sendEmail($subject, $emailMessage, $email);

      return true;
    }

    return false;
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
