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
          $PostCode;
  // Default constructor
  public function __construct($user = null)
  {
    $this->_db = DB::getInstance();
    $this->_sendMail = Email::getInstance();

    $this->_sessionName = Config::get('sessions/session_name');

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
    

    Session::put($this->_sessionName, $this);
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



 

}
