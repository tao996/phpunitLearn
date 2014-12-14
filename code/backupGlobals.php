<?php 
$GData = array(
	'book'=>'PHPUnit',
	'pdo'=>new PDO('mysql:dbname=test;host=127.0.0.1','root',''),
	'temp'=>array(1,2,3)
	);
/**
 * @backupGlobals disabled
 */
class BackupGlobalsTest extends PHPUnit_Framework_TestCase{
	public static $total = 0;
	
	public function testOne(){
		global $GData;
		$this->assertEquals($GData['book'],'PHPUnit');
		//$GData['book'] = 'PHP Document';//修改了全局变量
		self::$total ++;
	}

	public function testTwo(){
		global $GData;
		$this->assertEquals($GData['book'],'PHPUnit');
		$this->assertEquals(self::$total,1);
	}
}