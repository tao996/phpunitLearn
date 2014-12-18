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
	/*
	public function testDouble(){
		$this->_calAdd->append(45);
		$this->_calculator->expects($this->any())->method('double')->with(45)->will($this->returnValue(90));
		//因为使用了 $this->any() 所以不能再添加其它代码了
		$this->assertEquals(90, $this->_calAdd->double2());
	}
	*/
/*
	public function testDouble2(){
		$this->_calAdd->append(45);
		$this->_calculator->expects($this->at(0))->method('double')->with(45)->will($this->returnValue(90));
		$this->_calAdd->append(76);
		$this->_calculator->expects($this->at(1))->method('double')->with(76)->will($this->returnValue(152));
		$this->assertEquals(242, $this->_calAdd->double2());
	}
*/
/*
	public function testMc(){
		$this->_calculator->expects($this->any())->method('mc')->will($this->returnArgument(0));
		$this->assertEquals(75, $this->_calAdd->mc(75));
	}
*/	
/*
	public function testmadd(){
		$this->_calculator->expects($this->any())->method('madd')->will($this->returnSelf());
		$this->assertEquals($this->_calculator, $this->_calAdd->madd(70));
	}
*/
/*
	public function testReturnValueMap(){
		$map = array(
				array(15,14,29),
				array(25,33,58)
				);
		$this->_calculator->expects($this->any())->method('sum')->will($this->returnValueMap($map));
		$this->assertEquals(29, $this->_calAdd->sum(15,14));
		$this->assertEquals(58, $this->_calAdd->sum(25,33));
	}
*/
/*
	public function testDate(){
		$this->_calculator->expects($this->any())->method('date')->will($this->returnCallback('date'));
		$this->assertEquals('2014-12-14', $this->_calAdd->date('Y-m-d'));//请自行修改值
	}
*/	
/*
	public function testCalType(){
		$this->_calculator->expects($this->any())->method('rand')->will($this->onConsecutiveCalls(1,2,3,4));
		$this->assertEquals('add', $this->_calAdd->calType());
		$this->assertEquals('subtract', $this->_calAdd->calType());
		$this->assertEquals('multiply', $this->_calAdd->calType());
		$this->assertEquals('divide', $this->_calAdd->calType());
	}
*/	
	/* ERROR
	public function testDivide(){
		$stub = $this->getMock('calAdd');
		$stub->expects($this->any())->method('divide')->will($this->throwException(new Exception('Division by zero')));
		$stub->divide(0);
	}
	*/
}


















