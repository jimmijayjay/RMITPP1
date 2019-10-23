<?php
class Res {
  /* [DATABASE HELPER FUNCTIONS] */
  protected $pdo = null;
  protected $stmt = null;
  public $error = "";
  public $lastID = null;

  function __construct() {
  // __construct() : connect to the database
  // PARAM : DB_HOST, DB_CHARSET, DB_NAME, DB_USER, DB_PASSWORD

    // ATTEMPT CONNECT
    try {
      $str = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
      if (defined('DB_NAME')) { $str .= ";dbname=" . DB_NAME; }
      $this->pdo = new PDO(
        $str, DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false
        ]
      );
      return true;
    }

    // ERROR - DO SOMETHING HERE
    // THROW ERROR MESSAGE OR SOMETHING
    catch (Exception $ex) {
      print_r($ex);
      die();
    }
  }

  function __destruct() {
  // __destruct() : close connection when done

    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  function exec($sql, $data=null) {
  // exec() : run insert, replace, update, delete query
  // PARAM $sql : SQL query
  //       $data : array of data
 
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
      $this->lastID = $this->pdo->lastInsertId();
    } catch (Exception $ex) {
      $this->error = $ex;
      return false;
    }
    $this->stmt = null;
    return true;
  }

  function fetch($sql, $cond=null, $key=null, $value=null) {
  // fetch() : perform select query
  // PARAM $sql : SQL query
  //       $cond : array of conditions
  //       $key : sort in this $key=>data order, optional
  //       $value : $key must be provided, sort in $key=>$value order

    $result = false;
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($cond);
      if (isset($key)) {
        $result = array();
        if (isset($value)) {
          while ($row = $this->stmt->fetch(PDO::FETCH_NAMED)) {
            $result[$row[$key]] = $row[$value];
          }
        } else {
          while ($row = $this->stmt->fetch(PDO::FETCH_NAMED)) {
            $result[$row[$key]] = $row;
          }
        }
      } else {
        $result = $this->stmt->fetchAll();
      }
    } catch (Exception $ex) {
      $this->error = $ex;
      return false;
    }
    $this->stmt = null;
    return $result;
  }





  /* [DATE RANGE BOOKING] */
  function bookRangeValidate ($name, $email, $tel, $start, $end, $notes="", $vehicle_id) {
  // bookRange() : reserve for the date range

    // Check if customer already booked within the date range
    $sql = "SELECT * FROM `BookingsCurrent` WHERE (((`BookingStartTime` BETWEEN ? AND ?) OR (`BookingEndTime` BETWEEN ? AND ?)) AND `VehicleID` = ?)";
    $cond = [$start, $end, $start, $end, $vehicle_id];
    $check = $this->fetch($sql, $cond); 
    if (count($check)>0) {
      $this->error = "This car is not available for the whole period between " . $start . " and " . $end;
      return false;
    }
    
    //Check whether the user has logined
//    session_start();
//    if ( !isset($_SESSION["carbuddy"]) || (isset($_SESSION["carbuddy"]) && !$_SESSION["carbuddy"]->isLoggedIn())) {
//        return 2;
//    }
    if(!session_start()){
        session_start();
    };
    $_SESSION['start'] = $start;
    $_SESSION['end'] = $end;
    $_SESSION['vehicle_id'] = $vehicle_id;

    return 1;

    // Process reservation
//    $sql = "INSERT INTO `BookingsCurrent` (`BookingStartTime`, `BookingEndTime`, `VehicleID` ) VALUES (?,?,?)";
//    $cond = [$start, $end, $vehicle_id];
//    echo "This code is running";
//    return $this->exec($sql, $cond);
    //return 2;
    
  }

  
   function bookRange ($name, $email, $tel, $start, $end, $notes="", $vehicle_id, $FeePerHour, $Hours, $TotalFee){
  // bookRange() : reserve for the date range

    // Check if customer already booked within the date range
    $sql = "SELECT * FROM `BookingsCurrent` WHERE (((`BookingStartTime` BETWEEN ? AND ?) OR (`BookingEndTime` BETWEEN ? AND ?)) AND `VehicleID` = ?)";
    $cond = [$start, $end, $start, $end, $vehicle_id];
    $check = $this->fetch($sql, $cond); 
//    if (count($check)>0) {
//      $this->error = "This car is not available for the whole period between " . $start . " and " . $end;
//      return false;
//    }
    
    // Process reservation
    $sql = "INSERT INTO `BookingsCurrent` (`BookingStartTime`, `BookingEndTime`, `VehicleID`, `FeePerHour`, `Hours`, `BookingTotal` ) VALUES (?,?,?,?,?,?)";
    $cond = [$start, $end, $vehicle_id, $FeePerHour, $Hours, $TotalFee];
    $reult = $this->exec($sql, $cond);
    if($reult){
        return True;
    }
    
    return false;
    
  }
  /* [GET RESERVATION] */
  // @TODO - There are 101 ways to get/search for the reservations
  // This is a simple example that will get all reservations within a selected date range
  // Please do build your own functions in this library!
  function bookGet ($start, $end) {
  // bookGet() : get reservation for selected month/year
    $search = $this->fetch(
      "SELECT * FROM `reservations` WHERE `res_date` BETWEEN ? AND ?",
      [$start, $end]
    );
    return count($search)==0 ? false : $search ;
  }
}
?>