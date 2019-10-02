<?php

//$inputJSON = file_get_contents('php://input');
//$input = json_decode($inputJSON);

//$json = '{"action":"closed","b":2,"c":3,"d":4,"e":5,"pull_request":{"id":2342342,"number":2,"merged":false}}';
//$obj = json_decode($json);

//if ($input->action == "closed" && $input->pull_request->merged) {
  //print("got it<br/>");
  echo shell_exec("/home/ubuntu/bin/updateMaster 2>&1");
//}

//print_r($obj);
//echo $obj->action;

?>
