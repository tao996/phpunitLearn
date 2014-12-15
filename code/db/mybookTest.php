<?php
require_once 'PHPUnit/Extensions/Database/TestCase.php';

class MyBookTest extends PHPUnit_Extensions_Database_TestCase{
	//数据库连接
	public function getConnection(){
		$pdo =new PDO('mysql:dbname=test;host=127.0.0.1','root','');
		return $this->createDefaultDBConnection($pdo,'test');
	}
	//数据集
	public function getDataSet()
	{
		return $this->createFlatXMLDataSet(dirname(__FILE__).'/book.xml');
	}
	
	public function testDoSomething(){
		$expected_row_count = 6;
		$actual_row_count = $this->getConnection()->getRowCount('book');
		$this->assertEquals($expected_row_count, $actual_row_count);
		
		$expected_table = $this->createMySQLXMLDataSet('./book.xml')->getTable('bookTest');
		$actual_table = $this->getConnection()->createQueryTable('book', 'SELECT * FROM `book`');
		$this->assertTablesEqual($expected_table, $actual_table);
	}
}