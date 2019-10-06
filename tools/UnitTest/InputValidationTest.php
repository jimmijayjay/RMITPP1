<?php

require_once '../InputValidation.php';
use PHPUnit\Framework\TestCase;

class InputValidationTest extends TestCase
{

    public function  testInputValidationEmail()
    {
        // test to ensure the database is connected
        $this -> assertTrue(!InputValidation::email("asdf")[0]);   
    }
    
    public function  testInputValidationPassword()
    {
        // test to ensure the database is connected
        $this -> assertTrue(InputValidation::password("123","123")[0]);   
    }
}