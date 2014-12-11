<?php 
require_once '../library/calculate.class.php';
class CalculateTest extends PHPUnit_Framework_TestCase{
	public function testSum(){
		$cal = new Calculate();
		$this->assertEquals($cal->sum(78,55),133);
		$this->assertEquals($cal->sum(79,51),129);
	}
}