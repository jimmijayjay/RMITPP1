<?php

  spl_autoload_register(function($class) {
    //require_once 'classes/' . $class . '.php';

    if (file_exists("classes/{$class}.php")) {
      require_once("classes/{$class}.php");
    } else if (file_exists("vendor/{$class}.php")) {
      require_once("vendor/{$class}.php");
    }

    /*if (file_exists('classes/' . $class . '.php')) {
      require_once 'classes/' . $class . '.php';

    } else if (file_exists('vendor/' . $class . '.php')) {
      require_once 'vendor/' . $class . '.php';
    }*/
  });

  session_start();

  $GLOBALS['config'] = array(
      'mysql' => array(
      'host' => '127.0.0.1',
      'username' => 'root',
      'password' => 'password23',
      'db' => 'car_buddy'
    ),
    'remember' => array(
      'cookie_name' => 'hash',
      'cookie_expiry' => 604800
    ),
    'sessions' => array(
      'session_name' => 'carbuddy',
      'token_name' => 'token'
    )
  );

  require_once 'sanitize.php';

?>
