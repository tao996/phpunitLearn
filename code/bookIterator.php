<?php
class bookXML implements Iterator {
	//首先我们有5个方法需要实现
	//移到首元素
	public function rewind(){
		$this->position = 0;
	}
	protected  $position;//当前位置
	//返回当前元素值
	public function current(){
		return $this->xml['book'][$this->position];
	}
	public  $xml;
	public function __construct() {
        $this->position = 0;
        $xml = simplexml_load_file('book.xml','SimpleXMLElement', LIBXML_NOCDATA);   
		$this->xml = json_decode(json_encode($xml), TRUE);
    }
	//返回当前元素键
	public function key(){
		return $this->position;
	}
	//下移一个元素
	public function next(){
		++$this->position;
	}
	//判定是否还有后续元素, 如果有, 返回true
	public function valid(){
		return isset($this->xml['book'][$this->position]);
	}
}
/*
echo "Start...\r\n";
$bookXML = new bookXML();
print_r($bookXML->xml);
echo "End...\r\n";
*/