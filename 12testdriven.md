## 测试驱动开发

[官方文档](https://phpunit.de/manual/3.7/zh_cn/test-driven-development.html)

一种先写测试脚本，再写实际开发代码的过程。即 测试脚本A -> 代码A -> 测试通过 -> 测试脚本B -> 代码B ....

接下来的例子，是官方提供的。

#### 银行帐户(BankAccount)的例子

银行帐户类 BankAccount 的方法：读写帐户余额，存钱，取钱

必须保证的条件：初始余额为0，余额不能变成负的。

现在开始编写一个可以测试初始余额为0的脚本

```
// librarytest/bankAccountTest.php
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
}
```

根据上面的测试脚本编写对应的类代码
```
// library/bankAccount.class.php
class BankAccount{
	private $_balance = 0;
	
	public function __construct(){
		$this->_balance = 0;
	}
	
	public function getBalance(){
		return $this->_balance;
	}
}
```

运行测试，结果：OK (1 test, 1 assertion)

继续在测试脚本中添加代码，用于测试另外一个必须保证的条件。
```
//余额不能小于0
public function testBalanceCannotBecomeNegative(){
	try{
		$this->ba->withdrawMoney(1);//取钱
	}catch (BankAccountException $e){
		$this->assertEquals(0, $this->ba->getBalance());
		return ;//有报异常才是正确的
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
```
编写对应的方法
```
// library/bankAccount.class.php
class BankAccountException extends Exception{}
// BankAccount 类下添加方法
public function setBalance($balance){
	if($balance >= 0)
		$this->_balance = $balance;
	else
		throw new BankAccountException;
}

public function depositMoney($balance){
	$this->setBalance($this->getBalance()+$balance);
	return $this->getBalance();
}

public function withdrawMoney($balance){
	$this->setBalance($this->getBalance()-$balance);
	return $this->getBalance();
}
```

运行测试，结果：OK (3 tests, 3 assertions)

两个条件已经测试完毕，现在来编写测试存钱取钱的测试脚本代码

```
// 存钱
public function testDepositMoney(){
	$this->assertEquals(45, $this->ba->depositMoney(45));
	$this->assertEquals(445, $this->ba->depositMoney(400));
	try {
		$this->ba->depositMoney(-1);//不可以存入负的数额
	}catch(BankAccountException $e){
		$this->assertEquals(445, $this->ba->getBalance());//余额不变
		return ;
	}
	$this->fail('error deposit money');
}
```

运行脚本，测试失败，需要修改 BankAccount 类的方法
```
public function depositMoney($balance){
	if($balance < 0)
		throw new BankAccountException('small than 0');
	$this->setBalance($this->getBalance()+$balance);
	return $this->getBalance();
}
```
再次运行测试，结果：OK (4 tests, 6 assertions)

接下来是取钱方法的测试脚本代码
```
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
```
根据上面的测试脚本修改 withdrawMoney 方法
```
public function withdrawMoney($balance){
	if($balance < 0)
		throw new BankAccountException('small than 0');
	if($this->getBalance()<$balance)
		throw new BankAccountException('not enough money');
	$this->setBalance($this->getBalance()-$balance);
	return $this->getBalance();
}
```
运行测试，结果：OK (6 tests, 9 assertions)

## 行为驱动开发

[官方文档](https://phpunit.de/manual/3.7/zh_cn/behaviour-driven-development.html) 说了一堆知识，但是我看不懂，你们自己理解吧。

我还是先看示例代码先

#### 保龄球游戏(BowlingGame)例子

首先是要定义保龄球得分的规则：
* 一局分为10轮(fram)
* 第1轮有2次投球机会来将10个球瓶击倒
* 每1轮的得分是击倒的球瓶总数 加上 全中(strike) 和 补中(spare) 带来的奖励
* 补中是指运行员用2次击球将10球瓶全部击倒，本轮的奖励是下1次击球所击倒的球瓶数
* 全中是指运行员用1次击球将10球瓶全部击倒，本轮的奖励是下2次击球所击倒的球瓶数

使用 PHPUnit_Extensions_Sotry_TestCase 把上面的规则写成脚本.(需要安装 PHPUnit_Extensions_Sotry_TestCase 扩展，可以在这里 [下载](https://github.com/sebastianbergmann/phpunit-story)，并且查看它的 Tests 示例)。当然示例的代码最好还是自己敲一遍啦。

* [BowlingGameSpec.php](https://github.com/sebastianbergmann/phpunit-story/blob/master/Tests/_files/BowlingGameSpec.php)
* [BowlingGame.php](https://github.com/sebastianbergmann/phpunit-story/blob/master/Tests/_files/BowlingGame.php)

执行结果：
```

[root@localhost librarytest]# phpunit BowlingGameTest.php
PHPUnit 3.7.22 by Sebastian Bergmann.

.....

Time: 10 ms, Memory: 3.25Mb

OK (5 tests, 5 assertions)
```