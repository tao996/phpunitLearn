<?php
class Subject{
	protected $stuList = array();
	// 添加学生（被通知对象）
	public function addStu(Student $stu){
		$this->stuList[] = $stu;
	}
	// 调用每个学生的 update 动作
	public function notify($args){
		foreach($this->stuList as $stu){
			$stu->update($args);
		}
	}
	public function warn(){
		$this->notify('The teacher is coming!');
	}
}

class Student{
	public function update($args){}
}

class Student1 extends Student{
	public function update($args){
		return 'OH,NO';
	}
}
class Student2 extends Student{
	public function update($args){
		return 'OVER';
	}
}