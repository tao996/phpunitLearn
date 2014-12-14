<?php
require_once 'bookIterator.php';

class BookProviderTest extends PHPUnit_Framework_TestCase{

	public function bookList(){
		return new bookXML;
		/*return array(
			array("author1","book1",65),
			array("author2","book2",75),
			array("author3","book3",85)
		);*/
	}
	
	/**
	 * @dataProvider bookList
	 */
	public function testBook($author,$title,$price){
		//作者不少于3个字
		$this->assertGreaterThanOrEqual(3,strlen($author));
		//标题不少于5个字
		$this->assertGreaterThanOrEqual(5,strlen($title));
		//价格不少于50元
		$this->assertGreaterThanOrEqual(50,intval($price));
	}
}