<?php

require_once '../db_connect.php';

class db_connectTest extends PHPUnit_Framework_TestCase
{
    public function setUp(){}
    public function tearDown() {}
    
    public function  testConnectionIsValid()
    {
        // test to ensure the database is connected
        $this -> assertTrue($db);
        
    }
}

