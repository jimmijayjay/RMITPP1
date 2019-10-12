<?php

  require_once 'includes/init.php';

  $message;

  if (isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash'])) {

    $user = new User();
    $db = DB::getInstance();

    $email = $db->_conn->real_escape_string($_GET['email']);
    $hash = $db->_conn->real_escape_string($_GET['hash']);

    if ($user->verify($email, $hash)) {
      $message = "<div>Your account has been activated, you can now login</div>" . '<p><a href="login.php" class="btn btn-primary mr-2 mb-2">login</a></p>';
    } else {
      $message = "Verification Failed. Please try again later.";
    }
  }

  include_once('includes/header.php');

?>

<section class="probootstrap-cover">
  <div class="container">
    <div class="row probootstrap-vh-100 align-items-center text-center">
      <div class="col-sm">
        <div class="probootstrap-text">
          <h1 class="probootstrap-heading text-white mb-4">
            <?php echo $message; ?></h1>
            <div class="probootstrap-subheading mb-5">
              <p class="h4 font-weight-normal"></p>
            </div>
            <!--<p><a href="registration.php" class="btn btn-primary mr-2 mb-2">Try It Now</a><a href="services.php" class="btn btn-primary btn-outline-white mb-2">See Range</a></p> -->
        </div>
      </div>
    </div>
  </div>
</section>

<?php include_once('includes/footer.php'); ?>
