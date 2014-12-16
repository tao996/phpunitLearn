<?php
require_once 'PHPUnit/Extensions/Database/TestCase.php';

class MyBookTest extends PHPUnit_Extensions_Database_TestCase{
	//数据库连接
	public function getConnection(){
		$pdo =new PDO('mysql:dbname=test;host=127.0.0.1','root','');
		$pdo->exec("SET NAMES 'utf8';");
		return $this->createDefaultDBConnection($pdo,'test');
	}

	//数据集
	public function getDataSet()
	{
		return $this->createMySQLXMLDataSet(dirname(__FILE__).'/book.xml');
		//return $this->createFlatXMLDataSet(dirname(__FILE__).'/flatbook.xml');
		//return $this->createXMLDataSet(dirname(__FILE__).'/book2.xml');
		//return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(dirname(__FILE__)."/yaml.yml");
		
		/* //测试失败 failed
		$dataSet = new PHPUnit_Extensions_Database_DataSet_CsvDataSet();
		$dataSet->addTable('book', dirname(__FILE__)."/book.csv");
		return $dataSet;
		*/
		/* //测试失败 failed
		require_once './MyApp_DbUnit_ArrayDataSet.php';
		return new MyApp_DbUnit_ArrayDataSet(array(
				'book'=>array(
						array("id"=>1, "author"=>"luke Welling", "title"=>"PHP和MySQL Web开发", "price"=>69.20, total=>30),
						array("id"=>2, "author"=>"高洛峰", "title"=>"细说PHP", "price"=>81.10, total=>50),
						array("id"=>3, "author"=>"列旭松", "title"=>"PHP核心技术与最佳实践", "price"=>71.20, total=>15),
						array("id"=>4, "author"=>"潘凯华", "title"=>"PHP开发实战1200例", "price"=>79.20, total=>61),
						array("id"=>5, "author"=>"麦金太尔", "title"=>"PHP编程实战", "price"=>56.40, total=>33),
						array("id"=>6, "author"=>"Matt Zandstra", "title"=>"深入PHP：面向对象、模式与实践", "price"=>58.70, total=>48)
						)
				));
		*/
	}
	public function testDoSomething(){//OK
		$expected_row_count = 6;
		$actual_row_count = $this->getConnection()->getRowCount('book');
		$this->assertEquals($expected_row_count, $actual_row_count);
	}
	public function testDo0(){
		$expected = $this->createMySQLXMLDataSet('./book.xml')->getTable('book');
		$actual = $this->getConnection()->createQueryTable('book', 'SELECT * FROM `book`');
		$this->assertTablesEqual($expected, $actual);
	}

	// from http://matthewturland.com/2010/01/04/database-testing-with-phpunit-and-mysql/
	public function testDo2(){
		$expected = $this->createMySQLXMLDataSet('./book.xml');
		$actual = new PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
		$actual->addTable('book', 'SELECT * FROM book');
		$this->assertDataSetsEqual($expected, $actual);
	}

	// form http://stackoverflow.com/questions/13801141/phpunit-testing-a-select-in-a-method-with-dataset
	public function testGetAll(){
		$expected = $this->getDataSet()->getTable("book");
		$actual =  $this->getConnection()->createQueryTable("book","SELECT * FROM book");
		$this->assertTablesEqual($expected,$actual);
	}
}