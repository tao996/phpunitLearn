<?php
class Replace {
	public function add($a){
		return $a + $this->double($a);
	}
	public function double($a){
		return $a + $a;
	}
}

class ReplaceTest extends PHPUnit_Framework_TestCase {
	public function testadd(){
		$replace = $this->getMock('Replace',array('double'));
		$replace->expects($this->any())->method('double')->will($this->returnValue(15));
		$data = $replace->add(6);
		$this->assertEquals(21, $data);
	}
}