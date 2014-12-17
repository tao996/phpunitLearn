<?php
class CompositeTest extends PHPUnit_Extensions_Database_TestCase {
	public function getConnection(){
		$pdo =new PDO('mysql:dbname=test;host=127.0.0.1','root','');
		$pdo->exec("SET NAMES 'utf8';");
		return $this->createDefaultDBConnection($pdo,'test');
	}
	
	public function getDataSet() {
		$ds1 = $this->createFlatXmlDataSet ( 'fixture1.xml' );
		$ds2 = $this->createFlatXmlDataSet ( 'fixture2.xml' );
		//成功，但不是我想要的
		$compositeDs = new PHPUnit_Extensions_Database_DataSet_CompositeDataSet (array($ds1));
		/* error
		$compositeDs = new PHPUnit_Extensions_Database_DataSet_CompositeDataSet ();
		$compositeDs->addDataSet ( $ds1 );
		$compositeDs->addDataSet ( $ds2 );
		*/
		/* error again
		 * $compositeDs = new PHPUnit_Extensions_Database_DataSet_CompositeDataSet (array($ds1,$ds2));
		 */
		return $compositeDs;
	}
	
	public function testCom0(){
		$actual = $this->getConnection()->createQueryTable('book', 'SELECT * FROM book');
		print_r($actual);
	}
}