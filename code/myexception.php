<?php 
class exceptionTest extends PHPUnit_Framework_TestCase{
    /**
     * @expectedException Exception
	 * @expectedExceptionMessageRegExp  /\d+/
     */
	 /*
    public function testExceptionMessageRegExp(){
		throw new Exception("SORRY",50);
    }
	*/
	/*
	public function testException() {
        $this->setExpectedException('InvalidArgumentException');
		throw new InvalidArgumentException("Error");
    }
	*/

	//public function testExceptionRegExp() {
    //    $this->setExpectedExceptionRegExp('InvalidArgumentException','/ER.*/',10);
	//	throw new InvalidArgumentException("ERror");
    //}
	
	public function testException() {
        try {
            throw new InvalidArgumentException("Error");
        }catch (InvalidArgumentException $expected) {
            return;
        }
        $this->fail('unknow Exception');
    }
}