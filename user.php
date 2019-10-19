<?php include_once('includes/header.php'); ?>

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
      <a href="user.php">Account Details</a>&nbsp;&nbsp;&nbsp;<a href="bookingHistory.php">Booking History</a>
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
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder= "<?php echo $_SESSION['car_buddy_firstname'];?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder= "<?php echo $_SESSION['car_buddy_lastname'];?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" palceholder= "<?php echo $_SESSION["car_buddy_email"];?>">
                <?php /*echo $_SESSION["email"];*/?>
              </div>
              <div class="form-group">
              <label for="password1">Password</label>
                <input type="password" class="form-control" id="password1" name="password1">
              </div>              <div class="form-group">
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
