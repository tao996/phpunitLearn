<?php
require_once dirname(__FILE__).'/calculate.class.php';

class calAdd{
	private $_calculator = null;
	
	public function getCalculate(){
		if(empty($this->_calculator))
			$this->_calculator = new Calculate();
		return $this->_calculator;
	}
	
	public function setCalculate(Calculate $calculator){
		$this->_calculator = $calculator;
	}
	
	private $_nums = array();
	public function append($num){
		array_push($this->_nums, intval($num));
	}
	
	public function total(){
		$cal = $this->getCalculate();
		$total = 0;
		if(!empty($this->_nums)){
			foreach($this->_nums as $n){
				$total = $cal->sum($n,$total);//引用类用到了自身的方法，测试替身必须规定这个方法如何实现
			}
		}
		return $total;
	}
	
	public function double2(){
		$cal = $this->getCalculate();
		$total = 0;
		foreach($this->_nums as $n){
			$total += $cal->double($n);//引用类用到了自身的方法，测试替身必须规定这个方法如何实现
		}
		return $total;
	}
	
	public function mc($num){
		$cal = $this->getCalculate();
		return $cal->mc($num);
	}
	
	public function madd($num){
		$cal = $this->getCalculate();
		return $cal->madd($num);
	}
	
	public function sum($num1,$num2){
		$cal = $this->getCalculate();
		return $cal->sum($num1,$num2);
	}
	
	public function date($format){
		$cal = $this->getCalculate();
		return $cal->date($format);
	}
	
	public function calType(){
		$cal = $this->getCalculate();
		switch ($cal->rand()){
			case 1: return 'add';break;
			case 2: return 'subtract';break;
			case 3: return 'multiply';break;
			case 4: return 'divide';break;
			default: return 'error';
		}
	}
	
	public function divide($num){
		if($num == 0)
			throw new Exception('Division by zero');
	}
}