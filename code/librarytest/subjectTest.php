<?php
require_once '../library/subject.php';

class SubjectTest extends PHPUnit_Framework_TestCase{
	public function testObserversUpdate(){
		//建立仿件对象，被通知的学生，只模仿update()方法
		$student1 = $this->getMock('Student1',array('update'));
		$student1->expects($this->once())->method('update')->with($this->equalTo('The teacher is coming!'));
		
		$student2 = $this->getMock('Student1',array('update'));
		//$student2->expects($this->once())->method('update')->with($this->stringContains('teacher'));
		$student2->expects($this->once())->method('update')->with($this->callback(function($msg){ return $msg =='The teacher is coming!';}));
		
		$subject = new Subject();
		$subject->addStu($student1);
		$subject->addStu($student2);
		$subject->warn();
	}
}