<?php 
class DependsTest extends PHPUnit_Framework_TestCase{
	public function testPlant(){
		$Foods = array();//食物
		$this->assertEmpty($Foods);//食物不需要吃
		array_push($Foods,'fruit');//长出了水果
		return $Foods;
	}
	/**
	 * @depends testPlant
	 */
	public function testPerson(array $Food){
		//检查是不是有水果可以吃
		$this->assertEquals(array_pop($Food),'fruit');
		//吃完水果拉出XX，再把XX扔出去
		array_push($Food,'XX');
		return $Food;
	}
	/**
	 * @depends testPerson
	 */
	public function testDog(array $Foods){
		$this->assertEquals(array_pop($Foods),'XX');
		//检查是不是吃完了
		$this->assertEmpty($Foods);
	}
}