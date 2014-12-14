<?php
class DependsAndProviderTest extends PHPUnit_framework_TestCase{
	// provider 要返回一个数组的数组
	public function provider(){
		return array(
			array('provider1'),
			array('provider2')
			);
	}
	// depends1 可以返回任意格式的值
	public function testDepends1(){
		$this->assertTrue(true);
		return 'first';
	}
	// depends2
	public function testDepends2(){
		$this->assertTrue(true);
		return 'second';
	}
	/**
	* @dataProvider provider2
	 * @depends testDepends1
	 * @depends testDepends2
	 * @dataProvider provider
	 */
	public function testConsumer(){
			//$this->assertEquals(array('provider1','first','second'),func_get_args());
			//$this->assertContains(func_get_arg(0),$this->dataExpect());
			$this->assertEquals(array('provider1'),func_get_arg(0));
	}
	public function dataExpect(){
		return array('provider1','provider2','provider3','provider4');
	}
	public function provider2(){
		return array(array('provider3'),array('provider4'));
	}
}