## 快速入门

其实之前已经看过几次 PHPUnit 了，但没次都是看不到一半就放弃了，因为搞不懂……，但是这次，我一定要学会它。

我最开始使用测试的经验不是使用PHPUnit，而是来自C语言，C语言中有一个简单的断言函数 assert()，它的用法是这样的

```
// 一个简单的求和函数
function sum(int a,int b){
	return a + b;
}
```
怎么测试上面的函数呢？在C中，我通常是这样写的
```
assert(sum(5,6)==11);
```
如果上面的判断没有通过，那么就会 die() 掉。

通过上面的例子，我们可以简单地认为测试，就是将一些数据输入到函数中，然后把函数的输出与我们认为的正确答案相比较，如果比较结果是一样的，那么就是通过测试，如果比较结果不一样，那么就是测试不通过。

在使用 PHPUnit 时，需要遵循 PHPUnit 的一些规则。

1. 类 Class 的测试需要写在 ClassTest 中
2. ClassTest （通常）继承自 PHPUnit_Framework_TestCase
3. 测试的方法必须是 public 的，以 test* 作为方法名或者在注释块中使用 @test

首先是最简单的，把上面的求各函数转为能够被 PHPUnit 测试的代码，新建 sum.php ，并输入以下代码

```
class SumTest extends PHPUnit_Framework_TestCase{
	
	public function sum($a,$b){
		return $a + $b;
	}

	public function testSum(){
		$this->assertEquals($this->sum(5,6),11);
		$this->assertEquals($this->sum(11,22),33);
	}
}
```

然后使用 PHPUnit 执行这个文件

<img src='./pic/01.png' />

你看到我的命令那么长，那是因为我是直接打开控制台（管理员身份），然后到 PHPUnit 目录下执行它的，因为我还没有配置 path，所以命令才那么长

<img src='./pic/02.png' />

有没有发现一个很无耐的地方，只有进入PHPUnit所在的盘，才可以直接使用命令，否则提示找不到路径。所以我只能把代码转移到E盘了

上面的 assertEquals 方法就类似于C语言中的assert()，都是用来测试结果是否为真。只不过 PHPUnit 的 assertEquals 使用两个参数，而C的 assert 传的是一个表达式。

以下是另外一个简单的示例，是向我们的开发环境靠拢的。首先建立目录
```
|-- library/
|		|-- calculate.class.php
|-- librarytest/
|		|-- calculate.class.php
```

假设 library/ 目录存放的是我们在项目中要使用到的类，而 librarytest/ 目录则是存放用来测试 library/ 目录对应的类的。

```
// library/calculate.class.php
class Calculate{
	public function sum($a,$b){
		return $a + $b;
	}
}
```

```
// librarytest/calculate.class.php
require_once '../library/calculate.class.php';
class CalculateTest extends PHPUnit_Framework_TestCase{
	public function testSum(){
		$cal = new Calculate();
		$this->assertEquals($cal->sum(78,55),133);
		$this->assertEquals($cal->sum(79,51),129);//故意写错
	}
}
```

添加完代码后，再次用 PHPUnit 测试，结果如下

<img src='./pic/03.png' />

我们可以看到测试结果：提示了错误的行数，还有期待的值。

### 测试依赖

官方文档说：PHPUnit 允许生产者(producer)返回一个测试基境(fixture)的实例，并将此实例传递给依赖于它的消费者(consumer)们。

我的理解就是：依赖就像一条这样的食物链，一棵植物吸入各种营养元素，长出了一个果实，果实被人吃了，人拉出为屎，屎又被狗给吃了。

虽然这个例子恶心了点，但希望好歹能帮助你理解。PHPUnit 使用 @depends 来标注依赖关系，下面我们就来写这个例子吧，新建文件 depends.php。

```
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
```

终于写完了，测试一下成果吧

<img src ='./pic/04.png' />

##### 多重依赖

Iphone6都出了这么久了，好想买一台呀。但是5000大洋呀，没钱，怎么办呢，只能跟死党A，B，C借了，结果死党们爽块地答应了。拿到借来的3堆零钱，我们得先算下，数额够不够。

```
//iphone6.php
class Iphone6Test extends PHPUnit_Framework_TestCase{
	public function testA(){
		return 2000;
	}
	public function testB(){
		return 2500;
	}
	public function testC(){
		return 499;
	}
	/**
	 * depends testA
	 * depends testB
	 * depends testC
	 */
	public function testAll(){
		//测试函数的前部分是我们想要的值，后面是事实上的值
		$this->assertEquals(array(2000,2500,499),func_get_args());
		$this->assertGreaterThanOrEqual(5000,array_sum(func_get_args()));
	}
}
```

赶快测试一下

<img src='./pic/05.png' />

那尼！居然少于5000，看来 iphone6 是买不到了









