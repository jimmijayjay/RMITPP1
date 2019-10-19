<?php include_once('includes/header.php'); ?>

    <section>
    <a href="bookingHistory.php">Booking History</a>
    </section>

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

    <section class="probootstrap-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form action="user.php" method="post" class="probootstrap-form mb-5">
            <?php include('tools/errors.php'); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder= "<?php echo $_SESSION['firstname'];?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder= "<?php echo $_SESSION['lastname'];?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" palceholder= "<?php echo $_SESSION["email"];?>">
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

<?php include_once('includes/footer.php'); ?>
