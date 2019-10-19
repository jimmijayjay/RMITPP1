<?php

class DB
{
  private static $_instance = null;
  public $_conn;

  private $_query,
          $_error = false,
          $_results,
          $_count = 0;

  private function __construct() {
    $this->_conn = new mysqli(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db'));

    if ($this->_conn->connect_errno) {
      printf("Connect failed: %s\n", $this->_conn->connect_error);
      exit();
    }
  }

  public static function getInstance() {
    if (!isset(self::$_instance)) {
      self::$_instance = new DB();
    }

    return self::$_instance;
  }

}
