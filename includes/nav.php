<?php

  if (isset($_SESSION[Config::get('sessions/session_name')])) {
    $thisUser = $_SESSION[Config::get('sessions/session_name')];
  } else {
    $thisUser = new User();
  }

?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark probootstrap-navabr-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">CAR BUDDY </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-nav" aria-controls="probootstrap-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="probootstrap-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
        <li class="nav-item"><a href="findCars.php" class="nav-link">Find Cars</a></li>
        <li class="nav-item"><a href="booking.php" class="nav-link">Make a Booking</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
        <?php if ($thisUser->isLoggedIn()) { ?>
          <li class="nav-item probootstrap-cta probootstrap-seperator"><a href="user.php" class="nav-link">Account</a></li>
          <li class="nav-item probootstrap-cta probootstrap-seperator"><a href="logout.php" class="nav-link">Log Out</a></li>
        <?php } else { ?>
          <li class="nav-item probootstrap-cta probootstrap-seperator"><a href="registration.php" class="nav-link">Sign up</a></li>
          <li class="nav-item probootstrap-cta"><a href="login.php" class="nav-link">Log In</a></li>
        <?php } ?>
      </ul>

    </div>
  </div>
</nav>
