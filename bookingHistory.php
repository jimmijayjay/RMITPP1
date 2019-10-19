<?php include_once('includes/header.php'); ?>

<section style="text-align: center;margin: 0 auto;">
<a href="user.php">Account Details</a>
</section>

<section class="probootstrap-cover">
<div class="container">
<div class="row probootstrap-vh-75 align-items-center text-left">
<div class="col-sm">
<div class="probootstrap-text pt-5">
<h1 class="probootstrap-heading text-white mb-4">Booking History</h1>
<div class="probootstrap-subheading mb-5">
<p class="h4 font-weight-normal">View all previous and current bookings<br><br>
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

<table style="width:90%;margin: 0 auto;">
<tr class="bookingHistoryTableHeaders">
<th>Date</th>
<th>Vehicle Type</th> 
<th>Vehicle Model</th>
<th>Booking Duration</th>
<th>Pick Up Location</th> 
<th>Drop Off Location</th>
<th>Booking Fee</th>
</tr>
<tr class="bookingHistoryTableBody">
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr class="bookingHistoryTableBody">
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr class="bookingHistoryTableBody">
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr class="bookingHistoryTableBody">
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr class="bookingHistoryTableBody">
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr class="bookingHistoryTableBody">
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
<!--<div class="row">
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
-->
</form>
</div>



<?php include_once('includes/footer.php'); ?>
