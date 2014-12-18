<?php 
class Calculate{
	public function sum($a,$b){
		return $a + $b;
	}
	
	public function double($a){
		return $a * 2;
	}
	
	public static $_mc = 0;
	public function mc($num){
		self::$_mc = $num;
		return $num;
	}
	
	public function madd($num){
		self::$_mc += $num;
		return $this;
	}
	
	public function date($format){
		return date($format);
	}
	
	public function rand(){
		return rand(1, 4);
	}
}