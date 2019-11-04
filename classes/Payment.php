<?php

class Payment
{

  // Set private variables
  private $FullName,
          $Email,
          $NameOnCard,
          $CardNumber,
          $ExpMonth,
          $ExpYear,
          $CardCVV,
          $Address,
          $State,
          $PostCode,
          $_db;
  // Default constructor
  public function __construct($user = null)
  {
    $this->_db = DB::getInstance();
    $this->_sendMail = Email::getInstance();


  }

  // Setup user
  private function setup( $FullName,$email,$NameOnCard,$CardNumber,$ExpMonth, $ExpYear, $CardCVV,   $Address,$State,$PostCode)
  {
    $this->FullName = $FullName;
    $this->Email = $Email;
    $this->NameOnCard = $NameOnCard;
    $this->CardNumber= $CardNumber;
    $this->ExpMonth = $ExpMonth;
    $this->ExpYear = $ExpYear;
    $this->CardCVV = $CardCVV;
    $this->Address = $Address;
    $this->State = $State;
    $this->PostCode = $PostCode;
    

  }
  
     public function calHours($start, $end){
          //count the number of objects within the periods

     
//    $start = new \DateTime($start);
//    $end = new \DateTime($end);
//
//    //determine what interval should be used - can change to weeks, months, etc
//    $interval = new \DateInterval('PT1H');
//
//    //create periods every hour between the two dates
//    $periods = new \DatePeriod($start, $interval, $end);
//
//    //count the number of objects within the periods
//    $hours = iterator_count($periods);
      
        $datetime1 = new DateTime($start);
        $datetime2 = new DateTime($end);
        $diff = $datetime2->diff($datetime1);
        $hours = round($diff->s / 3600 + $diff->i / 60 + $diff->h + $diff->days * 24, 2);
        return $hours;

     }
     
     public function getFeePerHour($vehicle_id){
        $mysqli = $this->_db->_conn; 
             //Get vehicle type name     
        $sql = "SELECT VehicleTypeName FROM VehicleDetails WHERE VehicleID = '$vehicle_id' ";   
        if($result = $mysqli->query($sql)->fetch_object()->VehicleTypeName){
               $VehicleType = $result;

        }
        $sql = "SELECT BookingFee FROM BookingRates WHERE VehicleTypeName = '$VehicleType' ";   
        if($result = $mysqli->query($sql)->fetch_object()->BookingFee){
            $VehicleFeePerHour = $result;
        }
        return $VehicleFeePerHour;
     }

     public function calFee($start, $end, $vehicle_id)
 {
         
    $VehicleFeePerHour = $this->getFeePerHour($vehicle_id);
    $hours = $this->calHours($start, $end); 
    $TotalFee = $VehicleFeePerHour*$hours;
         
    return $TotalFee;
        
  }
  
  public function recordCreditCardDetails($userID, $cardName, $cardNumber, $CVV, $cardExpYear, $cardExpMonth){
      $mysqli = $this->_db->_conn;
      $userID = mysqli_real_escape_string($mysqli, $userID);
      $cardName = mysqli_real_escape_string($mysqli, $cardName);
      $cardNumbe = mysqli_real_escape_string($mysqli, $cardNumbe);
      $CVV = mysqli_real_escape_string($mysqli, $CVV);
      $cardExpYear = mysqli_real_escape_string($mysqli, $cardExpYear);
      $cardExpMonth = mysqli_real_escape_string($mysqli, $cardExpMonth);
      $sql = "UPDATE Users SET CardName ='$cardName', CardNumber = '$cardNumber', CardCVV ='$CVV', CardExpYear='$cardExpYear', CardExpMonth = '$cardExpMonth' WHERE UserID ='$userID'"; 
      $result = $mysqli->query($sql); 
      if($result){
          return true;
      }          
      $return = false;
  }
  



 

}
