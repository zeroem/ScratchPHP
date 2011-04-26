<?php

class ObserverTest extends PHPUnit_Framework_TestCase {
	private static $subject;

	public static function setUpBeforeClass() {
		self::$subject = new TestSubject();
	}

	public static function tearDownAfterClass() {
		self::$subject = NULL;
	}
	
	public function testNotifyWithFailure() {
		ob_start();
		$ret = self::$subject->doFail();
		$output = ob_get_clean();

		$this->assertFalse($ret);
		$this->assertEquals("TestObserverOneFailsTestObserverTwo",$output);
	}

	public function testNotifyUntilWithFailure() {
		ob_start();
		$ret = self::$subject->doFailUntil();
		$output = ob_get_clean();

		$this->assertFalse($ret);
		$this->assertEquals("TestObserverOneFails",$output);
	}

	public function testNotify() {
		ob_start();
		$ret = self::$subject->doWin();
		$output = ob_get_clean();

		$this->assertTrue($ret);
		$this->assertEquals("TestObserverTwoTestObserverTwo",$output);
	}

	public function testNotifyUntil() {
		ob_start();
		$ret = self::$subject->doWinUntil();
		$output = ob_get_clean();

		$this->assertTrue($ret);
		$this->assertEquals("TestObserverTwoTestObserverTwo",$output);
	}
}


/*
  Supporting Objects for the Observer pattern Tests
*/

class TestObserverOneFails implements \Scratch\Utils\IObserver {
	public function doObserve(\Scratch\Utils\Event $event) {
		print __CLASS__;
		return false;
	}
}

class TestObserverTwo implements \Scratch\Utils\IObserver {
	public function doObserve(\Scratch\Utils\Event $event) {
		print __CLASS__;
	}
}

class TestSubject extends \Scratch\Utils\AbstractSubject {
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