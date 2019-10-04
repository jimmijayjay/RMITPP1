
<?php
include_once('tools/head.php'); 
include_once('tools/nav.php');
include_once 'tools/forgetpassword_server.php';?>

<form action="forgetpassword.php" method="post" class="probootstrap-form mb-5">
              <div class="form-group">
                <label for="email">Enter your email</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Reset Password">
              </div>

</form>




    



<?php include_once('tools/footer.php'); ?>  

