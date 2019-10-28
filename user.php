<?php

  require_once('includes/init.php');

  $errors = array();

  if (isset($_SESSION['car_buddy_userid']) && !empty($_SESSION['car_buddy_userid'])) {
    $user = new User($_SESSION['car_buddy_userid']);
  } else {
    $user = new User();
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = DB::getInstance();
    $validate = new Validate();

    $validate->check($_POST, array(
      'firstName' => array('required' => true),
      'lastName' => array('required' => true),
      'email' => array('required' => true),
      'password1' => array('required' => true),
      'password2' => array('required' => true)
    ));

    if ($validate->passed()) {
      $firstName = $db->_conn->real_escape_string($_POST['firstName']);
      $lastName = $db->_conn->real_escape_string($_POST['lastName']);
      $email = $db->_conn->real_escape_string(preg_replace('/\s+/', '', $_POST['email']));
      $password1 = $db->_conn->real_escape_string($_POST['password1']);
      $password2 = $db->_conn->real_escape_string($_POST['password2']);

      if (strlen($password1) > 50) {
          array_push($errors, "Password is too long");
      }

      if (strlen($firstName) > 100 OR strlen($lastName) > 100) {
          array_push($errors, "First name or last name is too long");
      }

      if ($password1 != $password2) {
          array_push($errors, "The two passwords are not the same");
      }

      if (count($errors) == 0) {
        if ($result = $user->update($firstName, $lastName, $email, $password1, $user->getUserID())) {
          Redirect::to('user_update_success_landing.php');
        } else {
          array_push($errors, "Account update failed. Please try again later.");
        }
      }
    }

    if (count($errors) > 0) {
      foreach($validate->errors() as $error) {
        array_push($errors, $error);
      }
    }

  }

  include_once('includes/header.php');

?>

    <!-- <section>
    <a href="bookingHistory.php">Booking History</a>
  </section> -->

     <section class="probootstrap-cover">
      <div class="container">
        <div class="row probootstrap-vh-75 align-items-center text-left">
          <div class="col-sm">
            <div class="probootstrap-text pt-5">
              <h1 class="probootstrap-heading text-white mb-4">Account Details </h1>
              <div class="probootstrap-subheading mb-5">
                <p class="h4 font-weight-normal">Update account details below<br><br>
                <!--This will allow you to log into our system and see when cars are available<br><br>
                You will need to finish your membership application and be activated before you can book --></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div id="account_submenu">
      <a href="user.php">Account Details</a>&nbsp;&nbsp;&nbsp;<a href="bookingHistory.php">Booking History</a>&nbsp;&nbsp;&nbsp;<a href="return.php">Return Car</a>
    </div>

    <section class="probootstrap-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form action="user.php" method="post" class="probootstrap-form mb-5">
            <?php include('includes/errors.php'); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value= "<?= $user->getFirstName() ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value= "<?= $user->getLastName() ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value= "<?= $user->getEmail() ?>">
              </div>
              <div class="form-group">
                <label for="password1">Password</label>
                <input type="password" class="form-control" id="password1" name="password1">
              </div>
              <div class="form-group">
                <label for="password2">Confirm Password</label>
                <input type="password" class="form-control" id="password2" name="password2">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Update Details">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

<?php include_once('includes/footer.php'); ?>
