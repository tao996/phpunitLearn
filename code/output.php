<?php 
class OutputTest extends PHPUnit_Framework_TestCase{
/*
    public function testExpectFooActualFoo(){
        $this->expectOutputString('foo');
        print 'foo';
    }

    public function testExpectBarActualBaz(){
        $this->expectOutputString('bar');
        print 'baz';
    }
*/
/*
	public function testExpectOutputRegex(){
		$this->expectOutputRegex('|llo|');
		echo "Hello World!";
	}
*/
	public function testSetOutputCallback(){
		$this->setOutputCallback('queryResult');
		print_r(array( 'id'=>2,'name'=>'Mr L'));
	}
}

function queryResult(){
	return array( 'id'=>2,'name'=>'Mr L');
}