## 测试替身

什么是测试替身？Sorry,I don't known; 但如果让我看一个实例，也许我就会明白啦，可惜的是我连这个实例应该怎么写都不知道。看看 [官方文档](https://phpunit.de/manual/3.7/zh_cn/test-doubles.html) 给我们提供哪些知识吧。

暂时不明白的知识

* 测试替身的概念
* 短连件(Stub)

也许有用的提示

* 使用 getMock() 可以建立一个短连件对象

现在我们已经有了自知之明啦，再加上官方的代码，我想肯定可以搞定那两个不明白的概念的，好，开始吧。

参考 官方教程 和 《PHP Master: Write Cutting-edge Code》，新建下面的文件和代码
```
// librarytest/calculateTest.php
require_once '../library/calculate.class.php';
class CalculateTest extends PHPUnit_Framework_TestCase{
	private $stub;
	public function setUp(){
		$this->stub = $this->getMock('Calculate');
	}

	public function testStub(){
		$this->stub->expects($this->any())->method('sum')->with(16,50)->will($this->returnValue(66));
	}
}
```
代码写好了，运行结果为：OK (2 tests, 2 assertions)

好，现在开始分析代码。当使用 getMock() 方法时，会生成一个测试替身类，那我们就把这个所谓的测试替身类打印出来，看看是什么样子的。

<img src='./pic/48.png' />

暂时看不出来什么信息，继续看文档。"所生成的测试替身类可以通过 getMock() 的可选参数进行配置"，好像我们上面没有使用到哦，那好，看下 getMock()方法的声明，但是好像得不到什么信息，跳过继续阅读文档。

默认情况下，测试替身的所有方法都返回NULL值，除非用will->($this->returnValue()) 之类的方法去修改它。
```
// 参考 《PHP精粹》 第7单元，P169
public function testStub(){
	$this->stub->expects($this->any())->method('sum')->with(16,50)->will($this->returnValue(66));
}
/*
expects($matcher):接受一个方法的引用，或者是将被模拟方法需要执行多少次
method():指出测试替身中哪一个方法将被模拟
with():相当于传递给方法的参数
will():指定方法调用的结果
*/
```
还是不太清楚，修改 library/calculate.class.php 文件，添加一个方法，再进行测试
```
// library/calculate.class.php
...
public function double($a){
	return $a * 2;
}
...
// librarytest/calculateTest.php
public function testStub3(){
	$stub = $this->getMock('Calculate');
	$stub->expects($this->any())->method('sum')->will($this->returnValue(66));
	$stub->expects($this->any())->method('double')->will($this->returnValue(16));
	$this->assertEquals(66, $stub->sum(44,22));
	$this->assertEquals(16, $stub->double(8));
}
// OK (2 tests, 4 assertions) 为什么有4个断言？
```

添加代码 `print_r($stub);`，然后根据打印现来的信息，大概可以知道上面的两行代码在内部是这个样子的（这里是便于理解）
```
$stub = array('matchers'=>array(
	array('method'=>'sum','parameters'=>66),
	array('method'=>'dobule','parameters'=>16)
));
```

现在我们可以猜测一下，`$stub->sum(44,22)` 本身就已经与 parameters 返回值进行了比较，为了验证我们的猜想，删除 $this->assertEquals()。
```
public function testStub3(){
	$stub = $this->getMock('Calculate');//为 Calculate 类创建短连件
	$stub->expects($this->any())->method('sum')->will($this->returnValue(66));
	$stub->expects($this->any())->method('double')->will($this->returnValue(16));
	$stub->sum(44,21);
	$stub->double(8);
}
// OK (2 tests, 2 assertions)
```

很好，验证了我们的猜测。同时，$stub 也是类 Calculate 是一个实例，我们可以使用它来调用 类中任何公开的方法。

写了这么多，我还是搞不懂测试替身有什么用呀……之所以没有删除上面的文字，只是想告诉你，有时候找到一本好的参考书是多么重要。像 phpunit 官方这种文档，只能让你越看越伤心。浪费了太多的时间了，我们重新开始学习吧。我们的参考资料是 [PHP Master: Write Cutting-edge Code](http://www.sitepoint.com/store/php-master-write-cutting-edge-code/) 的第7章 。Let's go...

如果类A中实例化了类B，那么在测试类A时，我们就可以制作类B的替身了（就像电影明星的替身一样，可以起到以假乱真的作用）。使用测试替身的好处在于：

* 减少依赖耦合
* 缩短测试时间，运行更加稳定
* 同时能对内部的输入输出进行验证，测试更彻底

那我们开始来体验一下吧。我们需要以下3个文件

```
// library/calculate.class.php 我们在上面已经使用过了
class Calculate{
	public function sum($a,$b){
		return $a + $b;
	}
}
// library/calAdd.class.php
require_once dirname(__FILE__).'/calculate.class.php';

class Double{
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
//引用类用到了自身的方法，将来测试替身必须规定这个方法如何实现
				$total = $cal->sum($n,$total);
			}
		}
		return $total;
	}
}
// librarytest/calAddTest.php
require_once dirname(dirname(__FILE__)).'/library/calAdd.class.php';

class calAddTest extends PHPUnit_Framework_TestCase{
	
	private $_calAdd = null;
	private $_calculator = null;
	
	public function setup(){
		$this->_calAdd = new calAdd();//要测试的类
		$this->_calculator = $this->getMock('Calculate');//测试类中的替身
		$this->_calAdd -> setCalculate($this->_calculator);
	}
	
	public function testTotal(){
		$this->_calAdd->append(29);
/*
$this->_calAdd->total() 方法中使用到了代码 $total = $cal->sum($n,$total);
测试替身必须 $cal->sum() 将如何实现
*/
		$this->_calculator->expects($this->at(0))->method('sum')->with(29,0)->will($this->returnValue(29));
/*
第1次循环时：调用代码为 29 = $cal->sum(29,0);
第1个29为返回值，第2个29是我们 append(29) 时添加的。
*/
		$this->assertEquals(29, $this->_calAdd->total());
	}
}
```

如果你看懂了上面的代码，那么继续为 calAddTest.php 中添加更加复杂的测试代码
```
public function testTotal2(){
	//记住 $cal->sum($n,$total) 中参数的顺序
	$this->_calAdd->append(45);
	$this->_calculator->expects($this->at(0))->method('sum')->with(45,0)->will($this->returnValue(45));
	$this->_calAdd->append(76);
	$this->_calculator->expects($this->at(1))->method('sum')->with(76,45)->will($this->returnValue(121));
	$this->_calAdd->append(14);
	$this->_calculator->expects($this->at(2))->method('sum')->with(14,121)->will($this->returnValue(135));
	$this->assertEquals(135, $this->_calAdd->total());
}
//还有其它两个测试，可以查看 calAddTest.php 文件
```

#### 其它资料：
[探索 Test Double 的状态集](http://msdn.microsoft.com/zh-cn/magazine/cc163358.aspx)