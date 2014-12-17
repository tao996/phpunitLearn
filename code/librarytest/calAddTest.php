<?php
require_once dirname(dirname(__FILE__)).'/library/calAdd.class.php';

class calAddTest extends PHPUnit_Framework_TestCase{
	
	private $_calAdd = null;
	private $_calculator = null;
	
	public function setup(){
		$this->_calAdd = new calAdd();//要测试的类
		$this->_calculator = $this->getMock('Calculate');//测试类中的替身
		$this->_calAdd -> setCalculate($this->_calculator);
	}
/*	
	public function testTotal(){
		$this->_calAdd->append(29);
		$this->_calculator->expects($this->at(0))->method('sum')->with(29,0)->will($this->returnValue(29));
		$this->assertEquals(29, $this->_calAdd->total());
	}
	
	public function testTotal2(){
		$this->_calAdd->append(45);
		$this->_calculator->expects($this->at(0))->method('sum')->with(45,0)->will($this->returnValue(45));
		$this->_calAdd->append(76);
		$this->_calculator->expects($this->at(1))->method('sum')->with(76,45)->will($this->returnValue(121));
		$this->_calAdd->append(14);
		$this->_calculator->expects($this->at(2))->method('sum')->with(14,121)->will($this->returnValue(135));
		$this->assertEquals(135, $this->_calAdd->total());
	}
*/	
	public function testDouble(){
		$this->_calAdd->append(45);
		$this->_calculator->expects($this->any())->method('double')->with(45)->will($this->returnValue(90));
		//因为使用了 $this->any() 所以不能再添加其它代码了
		$this->assertEquals(90, $this->_calAdd->double2());
	}
/*
	public function testDouble2(){
		$this->_calAdd->append(45);
		$this->_calculator->expects($this->at(0))->method('double')->with(45)->will($this->returnValue(90));
		$this->_calAdd->append(76);
		$this->_calculator->expects($this->at(1))->method('double')->with(76)->will($this->returnValue(152));
		$this->assertEquals(242, $this->_calAdd->double2());
	}
*/
}