<?php
/*
// 在建立好 Autoload.php, bootstrap.php, phpunit.xml 之后可以将下面3行代码注释
include_once './class/Foo.php';
include_once './class/Bar.php';
include_once './class/Baz.php';
*/
class FooTest extends PHPUnit_Framework_TestCase {
	public function testNewFoo(){
		$foo = new Foo();
		$this->assertEquals($foo->output(), 'Foo');
	}
	
	public function testNewBar() {
		$bar = new Bar();
		$this->assertEquals($bar->output(), 'Bar');
	}
	
	public function testNewBaz() {
		$baz = new Baz();
		$this->assertEquals($baz->output(), 'Baz');
	}
}