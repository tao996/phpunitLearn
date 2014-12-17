<?php
require_once '../library/calculate.class.php';
class CalculateTest extends PHPUnit_Framework_TestCase{
	/*
	 public function testSum(){
		$cal = new Calculate();
		$this->assertEquals($cal->sum(78,55),133);
	}
	public function testStub3(){
		$stub = $this->getMock('Calculate');//为 Calculate 类创建短连件
		$stub->expects($this->any())->method('sum')->will($this->returnValue(66));//配置
		$stub->expects($this->any())->method('double')->will($this->returnValue(16));
		//print_r($stub);
		$this->assertEquals(66, $stub->sum(44,21));//调用
		$this->assertEquals(16, $stub->double(8));
	}
	*/
	
	private $stub;
	public function setUp(){
		$this->stub = $this->getMock('Calculate');
	}
	
	public function testStub(){
		$this->stub->expects($this->any())->method('sum')->with(16,50)->will($this->returnValue(66));
	}
	public function testStub2(){
		$this->stub->expects($this->any())->method('double')->will($this->returnValue(16));
		$this->stub->double(8);
	}
}