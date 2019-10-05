<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class InputValidation {
    
    static function email($val){
        $val = filter_var($val, FILTER_VALIDATE_EMAIL);
        if ($val === FALSE){
            return [False, "Email is not valid"];        
        }elseif(strlen($val   ) > 100){
            return [False, "Email exceeds length limit"];
        }else{
            return [True, ""];
        }   
    }
    
 }

