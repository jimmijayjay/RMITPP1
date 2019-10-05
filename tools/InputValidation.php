<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class InputValidation {
    static $errors = array(); 
    
    static function email($val){
        $val = filter_var($val, FILTER_VALIDATE_EMAIL);
        if ($val === FALSE){
            self::throwError("Invalid Email", 903);
            array_push($errors, "Email not valid");
        }else{
          if (strlen($email) > 100) {
          array_push($errors, "Email is too long");
      }
        }
         
        return $val;
    }
    
    
}

