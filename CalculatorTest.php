<?php
require 'Calculator.php';
 
class CalculatorTests extends PHPUnit_Framework_TestCase
{
    private $calculator;
 
    protected function setUp()
    {
        $this->calculator = new Calculator();
    }
 
    protected function tearDown()
    {
        $this->calculator = NULL;
    }

    public function testAddEmptyString()
    {
        $result = $this->calculator->addStringNumbers("");
        $this->assertEquals(0, $result);
    }

    public function testAddOneStringNumber()
    {
        $result = $this->calculator->addStringNumbers("1");
        $this->assertEquals(1, $result);
    }

    public function testAddTwoStringNumbers()
    {
        $result = $this->calculator->addStringNumbers("1,2");
        $this->assertEquals(3, $result);
    }

    public function testAddManyStringNumbers()
    {
        $result = $this->calculator->addStringNumbers("1,5,8,9,8");
        $this->assertEquals(31, $result);
    }

    public function testAddGreaterThan1000()
    {
        $result = $this->calculator->addStringNumbers("1,1005");
        $this->assertEquals(1, $result);
    }

    public function testAddCustomDelimiter()
    {
        $result = $this->calculator->addStringNumbers("//[***]\n1***2***3");
        $this->assertEquals(6, $result);
    }

    public function testAddCustomDelimiters()
    {
        $result = $this->calculator->addStringNumbers("//[*][%]\n1*2%3");
        $this->assertEquals(6, $result);
    }

    public function testAddNegatives()
    {
       try {
           $result = $this->calculator->addStringNumbers("1,-1"); 
       } catch (Exception $e) {
           $this->assertEquals($e->getMessage(), "Negatives not allowed");
       }
       
    }

 
}

?>