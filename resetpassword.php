<?php

  require_once 'includes/init.php';

  $errors = array();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $db = DB::getInstance();

    $validate = new Validate();

    $validate->check($_POST, array(
      'password1' => array('required' => true),
      'password2' => array('required' => true)
    ));

    if ($validate->passed()) {
      $hash = $db->_conn->real_escape_string($_POST['hash']);
      $email = $db->_conn->real_escape_string($_POST['email']);
      $password1 = $db->_conn->real_escape_string($_POST['password1']);
      $password2 = $db->_conn->real_escape_string($_POST['password2']);

      if (strlen($password1) > 50) {
          array_push($errors, "Password is too long");
      }

      if ($password1 != $password2) {
          array_push($errors, "The two passwords are not the same");
      }

      if (count($errors) == 0) {
        $user = new User();

        if ($user->resetPassword($email, $hash, $password1)) {
          Redirect::to('resetpassword_success_landing.php');
        } else {
          array_push($errors, "Reset Password Failed. Please try again later.");
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

     <section class="probootstrap-cover">
      <div class="container">
        <div class="row probootstrap-vh-75 align-items-center text-left">
          <div class="col-sm">
            <div class="probootstrap-text pt-5">
              <h1 class="probootstrap-heading text-white mb-4">Reset Password </h1>
              <div class="probootstrap-subheading mb-5">
                <p class="h4 font-weight-normal">Enter your new password</p>
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
            <form action="resetpassword.php" method="post" class="probootstrap-form mb-5">
            <?php include('includes/errors.php'); ?>
              <div class="row">
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
                <input type="hidden" name="email" value="<?= $_GET['email'] ?>">
                <input type="hidden" name="hash" value="<?= $_GET['forgetpassword_hash'] ?>">
                <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Reset Password">
              </div>
            </form>
          </div>

          <div class="col-md-7 pr-md-5 pr-0">
            <h2 class="mb-5">Our Mission</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>


            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>

            <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>

            <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
          </div>
          <div class="col-md-5">
            <h2 class="mb-5">Why Us</h2>

            <div class="media mb-5">
              <div class="probootstrap-icon"><span class="icon-fingerprint display-4"></span></div>
              <div class="media-body">
                <h5 class="mt-0">Free Bootstrap 4</h5>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>

            <div class="media mb-4">
              <div class="probootstrap-icon"><span class="icon-users display-4"></span></div>
              <div class="media-body">
                <h5 class="mt-0">For The Community</h5>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>

            <div class="media mb-5">
              <div class="probootstrap-icon"><span class="icon-chat display-4"></span></div>
              <div class="media-body">
                <h5 class="mt-0">Support Us By Sharing This to Others</h5>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="probootstrap-section probootstrap-section-feature pb-0 probootstrap-overflow-hidden">
      <div class="container">
        <div class="row">
          <div class="col-md-6 pl-md-5 pb-5 order-md-2 order-1">
            <h2 class="mb-4 display-5 probootstrap-heading">Free Template by uiCookies</h2>
            <div class="probootstrap-item mb-4">
              <h3>Free Download</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
            </div>
            <div class="probootstrap-item mb-4">
              <h3>Keep Updated</h3>
              <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
            <div class="probootstrap-item mb-4">
              <h3>New Releases Every Week</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
            <div class="probootstrap-item mb-4">
              <h3>Donate Any Amount</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
          </div>

          <div class="col-md-6 pr-md-5 order-md-1 order-2">
            <div class="probootstrap-device">
              <img src="images/phone_3.png" alt="Free Bootstrap 4 Template by uicookies.com" class="img-fluid mb-md-0 mb-5">
            </div>
          </div>

        </div>
      </div>
    </section>

     bootstrapping
    <section class="probootstrap-section">
      <div class="container">
        <div class="row">
          <div class="col-md">
            <div class="media">
              <div class="probootstrap-icon"><span class="icon-fingerprint display-4"></span></div>
              <div class="media-body">
                <h5 class="mt-0">Free Bootstrap 4</h5>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="media">
              <div class="probootstrap-icon"><span class="icon-users display-4"></span></div>
              <div class="media-body">
                <h5 class="mt-0">For The Community</h5>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="media">
              <div class="probootstrap-icon"><span class="icon-chat display-4"></span></div>
              <div class="media-body">
                <h5 class="mt-0">Support Us By Sharing This to Others</h5>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php include_once('includes/footer.php'); ?>




<?php
/*
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    if(isset($_SESSION['s_email']) AND isset($_SESSION['s_forgetpassword_hash'])){ //user link has alreay been authenticated, display the form
         /*This should only happen when user submits form and there are validation errors*
         include_once './tools/resetpassword_page_template.php';
    }else{//user link has not been authenticated, perform authentication
         include_once './tools/resetpassword_auth_server.php';
         if (count($link_errors) === 0){ //link authentication is successful, display form
            /*store email and hash in session var in case there are password form input validation errors*
            $_SESSION['s_email'] = $_GET['email'];
            $_SESSION['s_forgetpassword_hash'] = $_GET['forgetpassword_hash'];
            include_once './tools/resetpassword_page_template.php';
        }
     }*/
?>
