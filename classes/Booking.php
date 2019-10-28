<?php

class Booking
{

  // Set private variables
  private $_db,
          $BookingID,
          $VehicleID,
          $VehicleTypeName,
          $VehicleMake,
          $VehicleModel,
          $BookingFee,
          $BookingTotal,
          $BookingDate,
          $BookingStartTime,
          $BookingEndTime,
          $UserID,
          $UserFirstName,
          $UserLastName;


  // Default constructor
  public function __construct($booking = null)
  {
    $this->_db = DB::getInstance();

    if(!is_null($booking)) {
      $thisBooking = $this->findByID($booking);
      $this->setup($thisBooking[0], $thisBooking[1], $thisBooking[2], $thisBooking[3], $thisBooking[4], $thisBooking[5], $thisBooking[6], $thisBooking[7], $thisBooking[8], $thisBooking[9], $thisBooking[10], $thisBooking[11], $thisBooking[12]);
    }
  }

  // Setup booking
  private function setup($bookingid, $vehicleid, $vehicleTypeName, $vehicleMake, $vehicleModel, $bookingFee, $bookingTotal, $bookingDate, $bookingStartDateTime, $bookingEndDateTime, $userid, $firstname, $lastname)
  {
    $this->BookingID = $bookingid;
    $this->VehicleID = $vehicleid;
    $this->VehicleTypeName = $vehicleTypeName;
    $this->VehicleMake = $vehicleMake;
    $this->VehicleModel = $vehicleModel;
    $this->BookingFee = $bookingFee;
    $this->BookingTotal = $bookingTotal;
    $this->BookingDate = $bookingDate;
    $this->BookingStartTime = $bookingStartDateTime;
    $this->BookingEndTime = $bookingEndDateTime;
    $this->UserID = $userid;
    $this->UserFirstName = $firstname;
    $this->UserLastName = $lastname;
  }

  // Getters
  public function getBookingID()
  {
    return $this->BookingID;
  }

  public function getVehicleID()
  {
    return $this->VehicleID;
  }

  public function getVehicleTypeName()
  {
    return $this->VehicleTypeName;
  }

  public function getVehicleMake()
  {
    return $this->VehicleMake;
  }

  public function getVehicleModel()
  {
    return $this->VehicleModel;
  }

  public function getBookingFee()
  {
    return $this->BookingFee;
  }

  public function getBookingTotal()
  {
    return $this->BookingTotal;
  }

  public function getBookingDate()
  {
    return $this->BookingDate;
  }

  public function getBookingStartTime()
  {
    return $this->BookingStartTime;
  }

  public function getBookingEndTime()
  {
    return $this->BookingEndTime;
  }

  public function getUserID()
  {
    return $this->UserID;
  }

  public function getUserFirstName()
  {
    return $this->UserFirstName;
  }

  public function getUserLastName()
  {
    return $this->UserLastName;
  }



  // Find by ID
  public function findByID($bookingid = null)
  {
    if ($bookingid) {
      if ($result = $this->_db->_conn->query("SELECT b.BookingID, b.VehicleID, v.VehicleTypeName, v.VehicleMake, v.VehicleModel, br.BookingFee, b.BookingTotal, b.BookingDate, b.BookingStartTime, b.BookingEndTime, b.UserID, u.FirstName, u.LastName FROM BookingsCurrent b INNER JOIN Users u ON b.UserID = u.UserID INNER JOIN VehicleDetails v ON b.VehicleID = v.VehicleID INNER JOIN BookingRates br ON v.VehicleTypeName = br.VehicleTypeName WHERE b.BookingID = $bookingid")) {
        return $result->fetch_array();
      }
    }

    return 0;
  }

  // Get data for booking Invoice
  public function getBookingInvoicePDF()
  {
    $return = array();
    return $return;
  }
}
