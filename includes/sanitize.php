<?php

  require_once 'init.php';

  function escape($string) {
      return htmlentities($string, ENT_QUOTES, 'UTF-8');
  }

?>
