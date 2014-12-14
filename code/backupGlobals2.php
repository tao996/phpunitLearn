<?php 
$GData = array(
	'book'=>'PHPUnit',
	);

class BackupGlobalsTest extends PHPUnit_Framework_TestCase{
	public static $total = 0;
	//建立一个静态属性备份还原的白名单
	protected $backupStaticAttributesBlacklist = array('BackupGlobalsTest'=>'total');
	
	public function testOne(){
		global $GData;
		$this->assertEquals($GData['book'],'PHPUnit');
		//$GData['book'] = 'PHP Document';//修改了全局变量
		self::$total ++;
	}

	public function testTwo(){
		global $GData;
		$this->assertEquals($GData['book'],'PHPUnit');
		//$this->assertEquals(self::$total,1);
		$this->assertEquals(self::$total,0);
	}
}