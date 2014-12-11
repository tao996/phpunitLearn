<?php
class SumTest extends PHPUnit_Framework_TestCase{
	
	public function sum($a,$b){
		return $a + $b;
	}

	public function testSum(){
		$this->assertEquals($this->sum(5,6),11);
		$this->assertEquals($this->sum(11,22),33);
	}
}