<?php
require_once dirname(dirname(__FILE__)).'/library/bankAccount.class.php';

class BankAccountTest extends PHPUnit_Framework_TestCase{
	protected $ba;
	public function setUp(){
		$this->ba = new BankAccount();
	}
	
	//初始帐户余额为0
	public function testBalanceIsInitiallyZero(){
		$this->assertEquals(0, $this->ba->getBalance());
	}
	//余额不能小于0
	public function testBalanceCannotBecomeNegative(){
		try{
			$this->ba->withdrawMoney(1);//取钱
		}catch (BankAccountException $e){
			$this->assertEquals(0, $this->ba->getBalance());
			return ;//有报异常才是正常的
		}
		$this->fail();
	}
	
	public function testBalanceCannotBecomeNegative2(){
		try{
			$this->ba->depositMoney(-1);//存钱
		}catch(BankAccountException $e){
			$this->assertEquals(0, $this->ba->getBalance());
			return ;
		}
		$this->fail();
	}
	
	public function testDepositMoney(){
		$this->assertEquals(45, $this->ba->depositMoney(45));
		$this->assertEquals(445, $this->ba->depositMoney(400));
		try {
			$this->ba->depositMoney(-1);
		}catch(BankAccountException $e){
			$this->assertEquals(445, $this->ba->getBalance());
			return ;
		}
		$this->fail('error deposit money');
	}
	
	public function testWithdrawMoney(){
		try{
			$this->ba->withdrawMoney(-1);//不准取负数
		}catch (BankAccountException $e){
			$this->assertEquals(0, $this->ba->getBalance());
			return ;
		}
		$this->fail();
	}

	public function testWithdrawMoney2(){
		$this->assertEquals(45, $this->ba->depositMoney(45));
		try{
			$this->ba->withdrawMoney(46);//存45，取46
		}catch(BankAccountException $e){
			$this->assertEquals(45, $this->ba->getBalance());//失败，但余额不变
			return ;
		}
		$this->fail();
	}

}