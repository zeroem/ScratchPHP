<?php

class ArrayUtilsTest extends PHPUnit_Framework_TestCase {
	public function testGet() {
		$testValue = "value";
		$arr = array("key"=>$testValue);
		$value = \scratch\util\ArrayUtils::get($arr,"key");
		$this->assertEquals($value,$testValue);
	}

	public function testGetDefault() {
		$arr = array("Key"=>"value");
		$value = \scratch\util\ArrayUtils::get($arr,"not a key",false);
		$this->assertFalse($value);
	}

	/**
	 * @expectedException \Exception
	 */
	public function testException() {
		$arr = array();
		\scratch\util\ArrayUtils::get($arr,"missing key with no default");
	}
}