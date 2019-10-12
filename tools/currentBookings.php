<?php
include_once('head.php');
session_start();
include_once('db_connect.php');


function array_multi_group_by_key($input_array, $key, $remove_key = false, $flatten_output = false)
{
    $output_array = [];
    foreach ($input_array as $array) {
        if ($flatten_output) {
            $output_array[$array[$key]] = $array;
            if ($remove_key) {
                unset($output_array[$array[$key]][$key]);
            }
        } else {
            $output_array[$array[$key]][] = $array;
            if ($remove_key) {
                unset($output_array[$array[$key]][0][$key]);
            }
        }
    }
    return $output_array;
}
      // Prepare a select statement
      $sql = "SELECT VehicleTypeName, VehicleMake, VehicleModel, VehicleID, VehicleSuburb, VehicleAddress, VehicleLatitude, VehicleLongitude FROM VehicleDetails";
      //echo $sql;
      $result = mysqli_query($db, $sql);
      //echo '<pre>'; print_r($result); echo '</pre>';

      

      $carArray = array();
      $index = 0;
      while($row = mysqli_fetch_assoc($result)){ // loop to store the data in an associative array.
        $carArray[$index] = $row;
        $index++;
      }

      //create multidimensional array
      $output_array = [];
      foreach($result as $array){
        $make = $array["VehicleMake"];
        $model = $array["VehicleModel"];
        $output_array[$array["VehicleTypeName"]][$make][$model][] = array('VehicleID'=>$array['VehicleID'],'VehicleSuburb'=>$array['VehicleSuburb'],'VehicleAddress'=>$array['VehicleAddress'],'VehicleLatitude'=>$array['VehicleLatitude'],'VehicleLongitude'=>$array['VehicleLongitude']);
        //$output_array2["VehicleTypeName"]["VehicleMake"]["VehicleModel"][] = array('VehicleLatitude'=>$array['VehicleLatitude'],'VehicleLongitude'=>$array['VehicleLongitude']);
        
          //echo "<br>".$sub["VehicleTypeName"]."<br>";
          //foreach($sub as $test){
          //  unset($sub["VehicleTypeName"]);
          //}

        //}
      }
      echo "<h1>output_array</h1>";
      echo '<pre>'; print_r($output_array); echo '</pre>';
      //echo "<h1>output_array2</h1>";
      //echo '<pre>'; print_r($output_array2); echo '</pre>';


?>
