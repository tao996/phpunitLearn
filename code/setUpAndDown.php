<?php
class setUpAndDownTest extends PHPUnit_Framework_TestCase {
	public function __construct(){ echo __METHOD__.' -> ';}
	public function __destruct(){ echo __METHOD__.' -> ';}
	public function setUp(){ echo __METHOD__.' -> ';}
	public function tearDown(){ echo __METHOD__.' -> ';}
	public static function setUpBeforeClass(){ echo __METHOD__.' -> ';}
	public static function tearDownAfterClass(){ echo __METHOD__.' -> ';}
	public function testOne(){ echo __METHOD__.' -> ';}
	public function testTwo(){ echo __METHOD__.' -> ';}
}