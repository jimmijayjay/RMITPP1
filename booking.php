<!DOCTYPE html>
<html lang="en">
<?php //include_once('tools/registration_server.php') ?>

 <?php include_once('tools/head.php'); ?>
  <body>
    <?php include_once('tools/nav.php'); ?>    
    <?php include_once('tools/currentBookings.php'); ?>    
    <pre>
    <?php print_r($_POST); ?>
    </pre>
     <section class="probootstrap-cover">
      <div class="container">
        <div class="row probootstrap-vh-75 align-items-center text-left">
          <div class="col-sm">
            <div class="probootstrap-text pt-5">
              <h1 class="probootstrap-heading text-white mb-4">Book a car </h1>
              <div class="probootstrap-subheading mb-5">
                <p class="h4 font-weight-normal">Book your car below.<br><br>
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
                        <form action="booking2.php" method="post" class="probootstrap-form mb-5">
                            <?php include('tools/errors.php'); ?>
                            <div class="form-group">
                                <label for="carT">Choose a Vehicle Type</label>
                                <select id="carType" name="carTy" onchange="modelFunction()">
                                    <option selected disabled>* Choose A Car Type *</option>
                                    <?php 
                                        foreach($output_array as $key => $value){
                                            echo $key." => ".$value;
                                                    ?>
                                                    <option value=<?php echo "['".$key."']"?>><?php echo $key;?> </option>
                                                    <?php
                                        }
                                    ?>
                                </select>
                                <label for="carC">Choose a Vehicle</label>
                                <select id="carChoice" name="carCh" onchange="locationFunction()">
                                    <option id="makeCarChoice" selected disabled> </option>
                                    <?php 
                                        /* foreach($output_array as $key => $value){
                                            echo $key." => ".$value;
                                            foreach($value as $key2 => $value2){
                                                echo $key2." => ".$value2;
                                                foreach($value2 as $key3 => $value3){
                                                    ?>
                                                    <option value=<?php echo "['".$key."']['".$key2."']['".$key3."']"?>><?php echo $key3;?> </option>
                                                    <?php
                                                }
                                            }
                                        }*/
                                    ?>
                                </select>
<!--                            </div>
                            <div class="form-group">
-->                            
                                <label for="location"> Choose your location</label>
                                <select name="location" id="location">
                                    <!--<option selected disabled>* Pick Model First *</option> -->
                                </select>
                            </div>
<!--                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="<?php echo $error;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password1">Password</label>
                                <input type="password" class="form-control" id="password1" name="password1">
                            </div>
                            <div class="form-group">
                                <label for="password2">Confirm Password</label>
                                <input type="password" class="form-control" id="password2" name="password2">
                            </div>
-->                             
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Book">
                            </div>
                          
                        </form>
                    </div>
                </div>
            </div>
        </section>
    
    <?php include_once('tools/footer.php'); ?>  
    
    <script>

    //////////////// function to change location on type selection //////////////////
        function modelFunction(){
            var carType = document.getElementById("carType").value;
            console.log(carType);
            String(carType);
            console.log(carType);
            var jArray1 = <?php echo json_encode($output_array); ?>;
            var str1 = "jArray1"
            var res = eval(str1.concat(carType));
            console.log(res);

            var loc = document.getElementById("carChoice");
            var l = document.getElementById("carChoice").length;
            var y = 0;
            while (y<l){
                loc.remove(loc);
                y=y+1;
            }
            var y = 0;

            var change = document.getElementById('carChoice');
            var option = document.createElement("option");
            var value = "test";
            var text = '* Choose A Car Model *';
            option.value = value;
            option.text = text;
            option.disabled = true;
            option.defaultSelected = true;
            change.add(option, loc[1]);       


            Object.keys(res).forEach(function(key) {
                console.log(key, res[key]);
                Object.keys(res[key]).forEach(function(subKey) {
                    console.log(subKey, key[subKey]);
                    var res3 = subKey;
                    var loc = document.getElementById("carChoice");
                    var option = document.createElement("option");
                    var value = carType+"['"+key+"']['"+subKey+"']";
                    option.value = value;
                    option.text = res3;
                    loc.add(option, loc[1]);
                });
            });

            // and remove any locations
            var loc = document.getElementById("location");
            var l = document.getElementById("location").length;
            var y = 0;
            while (y<l){
                loc.remove(loc);
                y=y+1;
            }

            /*while (y<x){
                var res3 = eval(str1.concat(carChoice).concat("[").concat(y).concat("]['VehicleLatitude']"));
                console.log(res3);
                var loc = document.getElementById("carChoice");
                var option = document.createElement("option");
                option.text = res3;
                loc.add(option, loc[2]);
                y = y+1;
            }
            transport_select.setAttribute("onchange", function(){toggleSelect(transport_select_id);});*/
        }
    


    //////////////// function to change location on model selection //////////////////
        function locationFunction(){
            var carChoice = document.getElementById("carChoice").value;
            console.log(carChoice);
            //String(carChoice);
            //console.log(carChoice);
            var jArray2 = <?php echo json_encode($output_array); ?>;
            var valueTest = jArray2['SUV']['Toyota']['Hilux'][0]['VehicleLatitude'];
            console.log(valueTest);
            var str1 = "jArray2"
            var res = eval(str1.concat(carChoice));
            console.log(res);
            var res2 = eval(str1.concat(carChoice).concat("[0]['VehicleLatitude']"));
            console.log(res2);
            var x = eval(str1.concat(carChoice)).length;;
            x = Number(x);
            console.log(x);
            var loc = document.getElementById("location");
            var l = document.getElementById("location").length;
            var y = 0;
            while (y<l){
                loc.remove(loc);
                y=y+1;
            }

            var change = document.getElementById('location');
            var option = document.createElement("option");
            var value = "test";
            var text = '* Choose A Location *';
            option.value = value;
            option.text = text;
            option.disabled = true;
            option.defaultSelected = true;
            change.add(option, loc[1]);      

            var y = 0;
            while (y<x){
                var res3 = eval(str1.concat(carChoice).concat("[").concat(y).concat("]['VehicleAddress']"));
                var id = eval(str1.concat(carChoice).concat("[").concat(y).concat("]['VehicleID']"));
                console.log(res3);
                console.log("car ID = "+ id);
                var loc = document.getElementById("location");
                var option = document.createElement("option");
                option.text = res3;
                option.value = id ;
                loc.add(option, loc[2]);
                y = y+1;
            }
        }


    </script>

    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    
  </body>
</html>
