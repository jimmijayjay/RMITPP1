<?php

  require_once 'includes/init.php';

  $errors = array();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = DB::getInstance();
    $validate = new Validate();

    $validate->check($_POST, array(
      'email' => array('required' => true)
    ));

    if ($validate->passed()) {
      $user = new User();

      $email = $db->_conn->real_escape_string(preg_replace('/\s+/', '', $_POST['email']));

      if ($user->forgetPassword($email)) {
        Redirect::to('forgetpassword_access_landing.php');
      }
    } else {
      foreach($validate->errors() as $error) {
        array_push($errors, $error);
      }
    }
  }

  include_once('includes/header.php');

?>

 <section class="probootstrap-cover">
  <div class="container">
    <div class="row probootstrap-vh-75 align-items-center text-left">
      <div class="col-sm">
        <div class="probootstrap-text pt-5">
          <h1 class="probootstrap-heading text-white mb-4">Password Reset </h1>
          <div class="probootstrap-subheading mb-5">
            <p class="h4 font-weight-normal">Enter your email to reset password<br><br>
            <!--This will allow you to log into our system and see when cars are available<br><br>
            You will need to finish your membership application and be activated before you can book --></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<form action="forgetpassword.php" method="post" class="probootstrap-form mb-5">
    <?php include('includes/errors.php'); ?>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Reset Password">
              </div>

</form>

<?php include_once('includes/footer.php'); ?>
