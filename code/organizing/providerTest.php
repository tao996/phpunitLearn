<?php 
class ProviderTest extends PHPUnit_Framework_TestCase{
	//首先是写一个返回数组的数组的方法，作为数据供给器，因为它需要被测试，所以不需要以test开头啦
	public function dataProvider(){
		return array(
			array(2,4,6),
			array(7,15,22),
			array(9,7,16)
		);
	}
	/**
	 * @dataProvider dataProvider
	 */
	public function testSum($a,$b,$sum){
		$this->assertEquals($a + $b,$sum);
	}
	
	public function testNothing(){
		echo __CLASS__;
	}
}