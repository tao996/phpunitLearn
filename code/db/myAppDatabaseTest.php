<?php
require_once "PHPUnit/Extensions/Database/TestCase.php";

abstract class MyAppDatabaseTest extends PHPUnit_Extensions_Database_TestCase{
	// 只实例化 pdo 一次，供测试的清理和基境读取使用。
	static private $pdo = null;

	// 对于每个测试，只实例化 PHPUnit_Extensions_Database_DB_IDatabaseConnection 一次。
	private $conn = null;

	final public function getConnection(){
		if ($this->conn === null) {
			if (self::$pdo == null) {
				self::$pdo = new PDO('sqlite::memory:');
			}
			$this->conn = $this->createDefaultDBConnection(self::$pdo, ':memory:');
		}
		return $this->conn;
	}
}