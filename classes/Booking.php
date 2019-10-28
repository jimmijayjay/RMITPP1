<?php

class Booking
{

  // Set private variables
  private $_db,
          $_sessionName,
          $BookingID,
          $VehicleID,
          $BookingType,
          $BookingTotal,
          $BookingDate,
          $BookingStartTime,
          $BookingEndTime,
          $BookingReturned,
          $UserFirstName,
          $UserLastName,
          $UserEmail,
          $UserID;


  // Default constructor
  public function __construct()
  {
    $this->_db = DB::getInstance();

    $this->_sessionName = Config::get('sessions/session_name');
  }

  // Getters
  public function getUserID()
  {
    return $this->UserID;
  }

  public function getBookingID()
  {
    return $this->BookingID;
  }

  public function getVehicleID()
  {
    return $this->VehicleID;
  }

  public function getBookingType()
  {
    return $this->BookingType;
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

  public function getBookingReturned()
  {
    return $this->BookingReturned;
  }
  
}