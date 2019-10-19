<?php include_once('includes/header.php'); ?>

    <section class="probootstrap-cover">
      <div class="container">
        <div class="row probootstrap-vh-75 align-items-center text-left">
          <div class="col-sm">
            <div class="probootstrap-text pt-5">
              <h1 class="probootstrap-heading text-white mb-4">Book a car </h1>
              <div class="probootstrap-subheading mb-5">
                <p class="h4 font-weight-normal">Pick your times<br><br>
                <!--This will allow you to log into our system and see when cars are available<br><br>
                You will need to finish your membership application and be activated before you can book --></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php

      if (isset($_SESSION['car_buddy_userid'])) {
        $firstname = $_SESSION['car_buddy_firstname'];
        $email = $_SESSION['car_buddy_email'];
      } else {
        $firstname = "New user";
        $email = "New user";
      }

      /*if ($_SESSION['firstname'] = NULL) {
        $_SESSION['firstname'] = "New user";
        $_SESSION['email'] = "New User";
      }*/

      $vehicle_id = $_POST['location'];
    ?>
    <section class="probootstrap-section">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
              <form id="res_form" onsubmit="return res.save()">
                <input type="hidden" id="res_name" value="<?= $firstname ?>"/>
                <input type="hidden" id="res_email" value="<?= $email ?>"/>
                <input type="hidden" id="res_tel" value="No Phone Number Stored">
                <input type="hidden" id="res_notes" value="test"/>
                <label for="vehicle_id">Vehicle ID = <?= $vehicle_id ?></label>
                <input type="hidden" required id="vehicle_id"  value="<?= $vehicle_id ?>"/>
                <!-- Model and location info to be printed here and past on at post --->
                <label>Reservation Start Date</label>
                <div id="res_start" class="calendar"></div>
                <label>Reservation Start Time</label>
                <div id="res_slot_start"></div>
                <label>Reservation End Date</label>
                <div id="res_end" class="calendar"></div>
                <label>Reservation End Time</label>
                <div id="res_slot_end"></div>
              <button id="res_go" disabled>Submit</button>
            </form>
          </div>
        </div>
      </div>
    </section>
<?php include_once('includes/footer.php'); ?>
