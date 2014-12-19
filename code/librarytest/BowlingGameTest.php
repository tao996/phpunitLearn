<?php
require_once 'PHPUnit/Extensions/Story/TestCase.php';
require_once dirname(dirname(__FILE__)).'/library/BowlingGame.php';

class BowlingGameSpec extends PHPUnit_Extensions_Story_TestCase{
	/**
	 * @scenario
	 */
	public function scoreForGutterGameIs0(){
		$this->given('New game')->then('Score should be',0);
		// @scenario 是什么意思？ given(),then() 又是什么？
	}
	
	/**
	 * @scenario
	 */
	public function scoreForAllOnesIs20(){
		$this->given('New game')->when('Player rolls',1)
				->and('Player rolls',1)->and('Player rolls',1)->and('Player rolls',1)
				->and('Player rolls',1)->and('Player rolls',1)->and('Player rolls',1)
				->and('Player rolls',1)->and('Player rolls',1)->and('Player rolls',1)
				->and('Player rolls',1)->and('Player rolls',1)->and('Player rolls',1)
				->and('Player rolls',1)->and('Player rolls',1)->and('Player rolls',1)
				->and('Player rolls',1)->and('Player rolls',1)->and('Player rolls',1)
				->and('Player rolls',1)->then('Score should be',20);
		// ?? 完全看不懂
	}
	
	/**
	 * @scenario
	 */
	public function scoreForOneSpareAnd3Is16(){
		$this->given('New game')->when('Player rolls',5)
				->and('Player rolls',5)->and('Player rolls',3)
				->then('Score should be',16);
		//?? 1:5+5+3		2:3
	}
	/**
	 * @scenario
	 */
	public function scoreForOneStrikeAnd3And4Is24(){
		$this->given('New game')->when('Player rolls',10)
				->and('Player rolls',3)->and('Player rolls',4)
				->then('Score should be',24);
		//?? 1:10+3+4		2:3+4
	}
	/**
	 * @scenario
	 */
	public function scoreForPerfectGameIs300(){
		$this->given('New game')->when('Player rolls',10)
				->and('Player rolls',10)->and('Player rolls',10)->and('Player rolls',10)
				->and('Player rolls',10)->and('Player rolls',10)->and('Player rolls',10)
				->and('Player rolls',10)->and('Player rolls',10)->and('Player rolls',10)
				->and('Player rolls',10)->and('Player rolls',10)
				->then('Score should be',300);
		//?? 1:30,2:30,3:30,4:30,5:30,6:30,7:30,8:30,9:20,10:10 = 270
	}
	
	public function runGiven(&$world,$action,$arguments){
		switch($action){
			case 'New game':{
				$world['game'] = new BowlingGame();
				$world['rolls'] = 0;
			}
			break;
			default:{
				return $this->notImplemented($action);
			}
		}
	}
	
	public function runWhen(&$world,$action,$arguments){
		switch($action){
			case 'Player rolls':{
				$world['game']->roll($arguments[0]);
				$world['rolls']++;
			}
			break;
			default:{
				return $this->notImplemented($action);
			}
		}
	}
	
	public function runThen(&$world,$action,$arguments){
		switch($action){
			case 'Score should be':{
				for($i = $world['rolls'];$i<20;$i++)
					$world['game']->roll(0);
				$this->assertEquals($arguments[0],$world['game']->score());
			}
			break;
			default:{
				return $this->notImplemented($action);
			}
		}
	}
}