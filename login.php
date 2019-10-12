<?php

  require_once 'includes/init.php';

  $errorMessage;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validate = new Validate();

    $validate->check($_POST, array(
      'email' => array('required' => true),
      'password' => array('required' => true)
    ));

    if ($validate->passed()) {
      $user = new User();
      
      if ($user->login($_POST['email'], $_POST['password'])) {
        Redirect::to('index.php');
      }
    } else {
      foreach($validate->errors() as $error) {
        $errorMessage .= $error . '<br>';
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
          <h1 class="probootstrap-heading text-white mb-4">Log In </h1>
          <div class="probootstrap-subheading mb-5">
            <p class="h4 font-weight-normal">Log in to start browsing cars and make bookings<br><br>
            <!--This will allow you to log into our system and see when cars are available<br><br>
            You will need to finish your membership application and be activated before you can book --></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="probootstrap-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="login.php" method="post" class="probootstrap-form mb-5">
        <p style="color: red;">
          <?php
            if (!empty($errorMessage)) {
              echo $errorMessage;
            }
          ?>
        </p>

          <div class="row">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Please enter your email" value="<?php echo $email; ?>">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control"name="password" placeholder="Please enter your password" value="<?php echo $entered_password; ?>">
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Login">
          </div>
          <div>
              <p><a href="forgetpassword.php">Forget Password</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include_once('includes/footer.php'); ?>
