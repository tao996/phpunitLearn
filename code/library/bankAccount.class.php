<?php
class BankAccount{
	private $_balance = 0;
	
	public function __construct(){
		$this->_balance = 0;
	}
	
	public function getBalance(){
		return $this->_balance;
	}
	
	public function setBalance($balance){
		if($balance >= 0)
			$this->_balance = $balance;
		else
			throw new BankAccountException;
	}
	
	public function depositMoney($balance){
		if($balance < 0)
			throw new BankAccountException('small than 0');
		$this->setBalance($this->getBalance()+$balance);
		return $this->getBalance();
	}

	public function withdrawMoney($balance){
		if($balance < 0)
			throw new BankAccountException('small than 0');
		if($this->getBalance()<$balance)
			throw new BankAccountException('not enough money');
		$this->setBalance($this->getBalance()-$balance);
		return $this->getBalance();
	}

}

class BankAccountException extends Exception{}