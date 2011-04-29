<?php

require_once("PHPUnit/Extensions/OutputTestCase.php");

class ObserverTest extends PHPUnit_Extensions_OutputTestCase {
	private static $subject;

	public static function setUpBeforeClass() {
		self::$subject = new TestSubject();
	}

	public static function tearDownAfterClass() {
		self::$subject = NULL;
	}
	
	public function testNotifyWithFailure() {
		$this->expectOutputString("TestObserverOneFailsTestObserverTwo");
		$ret = self::$subject->doFail();
		$this->assertFalse($ret);
	}

	public function testNotifyUntilWithFailure() {
		$this->expectOutputString("TestObserverOneFails");
		$ret = self::$subject->doFailUntil();
		$this->assertFalse($ret);
	}

	public function testNotify() {
		$this->expectOutputString("TestObserverTwoTestObserverTwo");
		$ret = self::$subject->doWin();
		$this->assertTrue($ret);
	}

	public function testNotifyUntil() {
		$this->expectOutputString("TestObserverTwoTestObserverTwo");
		$ret = self::$subject->doWinUntil();
		$this->assertTrue($ret);
	}

	public function testCount() {
		$this->assertEquals(self::$subject->countObservers(),4);
	}

	public function testRemove() {
		$subject = new TestSubject();
		$subject->removeObserver($subject::SUCCESS);
		$this->assertEquals($subject->countObservers(),2);

		$subject->removeObserver($subject::FAILED,new TestObserverTwo());
		$this->assertEquals($subject->countObservers(),1);
	}
}


/*
  Supporting Objects for the Observer pattern Tests
*/

class TestObserverOneFails implements \scratch\util\IObserver {
	public function doObserve(\scratch\util\Event $event) {
		print __CLASS__;
		return false;
	}
}

class TestObserverTwo implements \scratch\util\IObserver {
	public function doObserve(\scratch\util\Event $event) {
		print __CLASS__;
	}
}

class TestSubject extends \scratch\util\AbstractSubject {
	const FAILED = "test.fail";
	const SUCCESS = "test.success";

	public function __construct() {
		$this->observe(self::FAILED, new TestObserverOneFails());
		$this->observe(self::FAILED, new TestObserverTwo());
		$this->observe(self::SUCCESS, new TestObserverTwo());
		$this->observe(self::SUCCESS, new TestObserverTwo());
	}

	public function doWin() {
		return $this->notify($this->makeEvent(self::SUCCESS,__FUNCTION__));
	}

	public function doWinUntil() {
		return $this->notifyUntil($this->makeEvent(self::SUCCESS,__FUNCTION__));
	}

	public function doFail() {
		return $this->notify($this->makeEvent(self::FAILED,__FUNCTION__));
	}

	public function doFailUntil() {
		return $this->notifyUntil($this->makeEvent(self::FAILED,__FUNCTION__));
	}
}